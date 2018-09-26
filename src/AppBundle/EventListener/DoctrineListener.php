<?php

namespace AppBundle\EventListener;

use AppBundle\Entity\Group;
use AppBundle\Entity\User;
use \Doctrine\ORM\Event\LifecycleEventArgs;
use \AppBundle\Entity\Newsletter;
use Doctrine\ORM\Event\OnFlushEventArgs;

class DoctrineListener
{
  protected $mailer;

  /**
   * DoctrineListener constructor.
   */
  public function __construct($mailer)
  {
    $this->mailer = $mailer;
  }

  public function prePersist(LifecycleEventArgs $args)
  {
    $entity = $args->getEntity();

    if (!$entity instanceof  Newsletter) {
      return;
    }

    $em = $args->getEntityManager();
    $emailRepository = $em->getRepository('AppBundle:Email');

    $emails = $emailRepository->findAll();

    foreach ($emails as $to) {
      $message = \Swift_Message::newInstance()
        ->setSubject($entity->getSubject())
        ->setFrom('contact@horizonscaboverde.com')
        ->setTo($to->getEmail())
        ->setBody($entity->getContent(), 'text/html');
      $this->mailer->send($message);
    }
  }

  public function onFlush(OnFlushEventArgs $args)
  {
    $em = $args->getEntityManager();
    $uow = $em->getUnitOfWork();

    $entities = array_merge(
      $uow->getScheduledEntityInsertions(),
      $uow->getScheduledEntityUpdates()
    );

    foreach ($entities as $entity) {
      if ($entity instanceof User) {
        $group = $entity->getGroups()->first();

        if ($group instanceof Group) {

          $groupName = $group->getName();
          $groupNumber = 0;

          switch ($groupName) {
            case 'Niveau 1':
              $groupNumber = '1';
              break;
            case 'Niveau 2':
              $groupNumber = '2';
              break;
            case 'Niveau 3':
              $groupNumber = '3';
              break;
            case 'Niveau 4':
              $groupNumber = '4';
              break;
            case 'Fondateur':
              $groupNumber = '9';
              break;
          }

          $group->addCount();
          $numeroCarte = $group->getCount();

          $hcode = '31012004' . $groupNumber . sprintf('%07d', $numeroCarte);
          $hcode = implode(' ', str_split($hcode, 4));

          $entity->setHcode($hcode);

          $em->persist($group);
          $md = $em->getClassMetadata('AppBundle\Entity\Group');
          $uow->recomputeSingleEntityChangeSet($md, $group);
        }
      }
    }

  }

}