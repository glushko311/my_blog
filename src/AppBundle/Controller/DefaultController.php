<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Controller\ApiController;
use AppBundle\Entity\Cat;
use AppBundle\Entity\Article;

class DefaultController extends ApiController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $catRepo = $this->entityManager->getRepository('AppBundle:Cat');
        $cat = $catRepo->all();
        $artRepo = $this->entityManager->getRepository('AppBundle:Article');
        $art = $artRepo->all();
        
        // replace this example code with whatever you need
        return $this->render('index.html.twig', ['articles'=>$art, 'categories'=>$cat]);
    }
}
