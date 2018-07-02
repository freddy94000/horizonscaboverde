<?php

namespace AppBundle\EventListener;

use \Doctrine\ORM\Event\LifecycleEventArgs;
use \AppBundle\Entity\Newsletter;

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
        ->setFrom('contact@horizonscaboverde.com ')
        ->setTo($to->getEmail())
        ->setBody($entity->getContent(), 'text/html');
      $this->mailer->send($message);
    }
  }

}