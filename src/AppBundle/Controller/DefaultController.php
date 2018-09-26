<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Email;
use AppBundle\Repository\BlockRepository;
use Application\Sonata\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sonata\MediaBundle\Entity\MediaManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    /**
     * @Route("/", name="test")
     */
    public function testAction(Request $request)
    {
        return $this->render('default/test.html.twig', []);
    }

    /**
     * @Route("/test2", name="test2")
     */
    public function index2Action(Request $request)
    {
        /** @var BlockRepository $blockRepository */
        $blockRepository = $this->getDoctrine()->getRepository('AppBundle:Block');
        $principal1 = $blockRepository->findOneBy(['code' => 'principal_1']);
        $principal2 = $blockRepository->findOneBy(['code' => 'principal_2']);
        $principal3 = $blockRepository->findOneBy(['code' => 'principal_3']);
        $entreprise = $blockRepository->findOneBy(['code' => 'entreprise']);
        $environnment = $blockRepository->findOneBy(['code' => 'environnement']);
        $sport = $blockRepository->findOneBy(['code' => 'sport']);
        $culture = $blockRepository->findOneBy(['code' => 'culture']);
        $adhesion = $blockRepository->findOneBy(['code' => 'adhesion']);

        /** @var MediaManager $mediaManager */
        $mediaManager = $this->get('sonata.media.manager.media');
        $principalVideo = $mediaManager->find(3);
        
        $email = new Email();
        $formNewsletter = $this->createFormBuilder($email)
          ->add('email', TextType::class, ['attr' => ['class' => 'form-control']])
          ->getForm();

        $formNewsletter->handleRequest($request);
        if ($formNewsletter->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();

            $this->addFlash('success', 'Votre inscription a bien été envoyé');
            return $this->redirectToRoute('homepage');
        }
        
        return $this->render('default/test2.html.twig', [
            'principal1' => $principal1,
            'principal2' => $principal2,
            'principal3' => $principal3,
            'entreprise' => $entreprise,
            'environnment' => $environnment,
            'sport' => $sport,
            'culture' => $culture,
            'adhesion' => $adhesion,
            'principalVideo' => $principalVideo,
            'formNewsletter' => $formNewsletter->createView()
        ]);
    }
    
    /**
     * @Route("/test", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var BlockRepository $blockRepository */
        $blockRepository = $this->getDoctrine()->getRepository('AppBundle:Block');

        $principal1 = $blockRepository->findOneBy(['code' => 'principal_1']);
        $principal2 = $blockRepository->findOneBy(['code' => 'principal_2']);
        $principal3 = $blockRepository->findOneBy(['code' => 'principal_3']);
        $entreprise = $blockRepository->findOneBy(['code' => 'entreprise']);
        $environnment = $blockRepository->findOneBy(['code' => 'environnement']);
        $sport = $blockRepository->findOneBy(['code' => 'sport']);
        $culture = $blockRepository->findOneBy(['code' => 'culture']);
        
        /** @var MediaManager $mediaManager */
        $mediaManager = $this->get('sonata.media.manager.media');
        $environnmentVideo = $mediaManager->find(2);
        $entrepriseVideo = $mediaManager->find(3);
        $sportVideo = $mediaManager->find(4);
        $cultureVideo = $mediaManager->find(5);
        $principalVideo = $mediaManager->find(6);

        /** @var \FOS\UserBundle\Doctrine\UserManager $userManager */
        $userManager = $this->get('fos_user.user_manager');
        /** @var User $user */
        $user = $userManager->createUser();
        $user->setPlainPassword('horizons');

        $form = $this->createFormBuilder($user)
          ->add('gender', ChoiceType::class, [
            'attr' => ['placeholder' => 'Civilité *', 'class' => 'form-control'],
              'choices' => [
                  'Monsieur' => 'm',
                  'Madame' => 'f'
              ]
          ])
          ->add('email', TextType::class, ['attr' => ['placeholder' => 'Email *', 'class' => 'form-control']])
          ->add('firstname', TextType::class, ['attr' => ['placeholder' => 'Prénom *', 'class' => 'form-control']])
          ->add('lastname', TextType::class, ['attr' => ['placeholder' => 'Nom *', 'class' => 'form-control']])
          ->add('address', TextType::class, ['attr' => ['placeholder' => 'Adresse', 'class' => 'form-control']])
          ->add('codePostal', TextType::class, ['attr' => ['placeholder' => 'Code Postal', 'class' => 'form-control']])
          ->add('city', TextType::class, ['attr' => ['placeholder' => 'Ville', 'class' => 'form-control']])
          ->add('phone', TextType::class, ['attr' => ['placeholder' => 'Téléphone', 'class' => 'form-control']])
          ->add('company', TextType::class, ['attr' => ['placeholder' => 'Entreprise', 'class' => 'form-control']])
          ->add('activity', TextType::class, ['attr' => ['placeholder' => 'Activité', 'class' => 'form-control']])
          ->add('proffession', TextType::class, ['attr' => ['placeholder' => 'Profession', 'class' => 'form-control']])
          ->getForm();

        $form->handleRequest($request);

        if ($form->isValid() && $user->getFirstname()) {
            $user->setUsername($user->getEmail());
            $userManager->updateUser($user);
            
            $this->addFlash('success', 'Votre inscription a bien été envoyé');
            return $this->redirectToRoute('homepage');
        }

        $email = new Email();
        $formNewsletter = $this->createFormBuilder($email)
          ->add('email', TextType::class, ['attr' => ['class' => 'form-control']])
          ->getForm();
        
        $formNewsletter->handleRequest($request);
        if ($formNewsletter->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($email);
            $em->flush();
            
            $this->addFlash('success', 'Votre inscription a bien été envoyé');
            return $this->redirectToRoute('homepage');
        }

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'principal1' => $principal1,
            'principal2' => $principal2,
            'principal3' => $principal3,
            'entreprise' => $entreprise,
            'environnement' => $environnment,
            'sport' => $sport,
            'culture' => $culture,
            'environnmentVideo' => $environnmentVideo,
            'entrepriseVideo' => $entrepriseVideo,
            'sportVideo' => $sportVideo,
            'cultureVideo' => $cultureVideo,
            'principalVideo' => $principalVideo,
            'form' => $form->createView(),
            'formNewsletter' => $formNewsletter->createView()
        ]);
    }
    
    
}
