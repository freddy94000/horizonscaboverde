<?php

namespace AppBundle\Controller;

use AppBundle\Repository\BlockRepository;
use Application\Sonata\MediaBundle\PHPCR\MediaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sonata\MediaBundle\Entity\MediaManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        /** @var BlockRepository $blockRepository */
        $blockRepository = $this->getDoctrine()->getRepository('AppBundle:Block');
        
        $blockPrincipal = $blockRepository->findOneByRank(0);

        $blocks = $blockRepository->findBy([], ['rank' => 'ASC']);
        
        /** @var MediaManager $mediaManager */
        $mediaManager = $this->get('sonata.media.manager.media');
        $medias = $mediaManager->findBy([], ['id' => 'DESC']);
        
        

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'blocks' => $blocks,
            'blockPrincipal' => $blockPrincipal,
            'medias' => $medias
        ]);
    }
}
