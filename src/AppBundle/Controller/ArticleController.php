<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 01.04.18
 * Time: 16:03
 */

namespace AppBundle\Controller;
use AppBundle\Controller\ApiController;
use AppBundle\Entity\Article;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\DateTime;


class ArticleController extends  ApiController
{
    /**
     * @Route("/articles", name="articles")
     */
    public function indexAction()
    {
        $catRepo = $this->entityManager->getRepository('AppBundle:Article');
        $cat = $catRepo->all();

        return $this->json($cat, 200);
    }


    /**
     * @Route("/article/new", name="article_new")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction(Request $request)
    {
        $name = $request->request->get('artName');
        $description = $request->request->get('artDescr');
        $catId = (int)$request->request->get('catId');

        $artRepo = $this->entityManager->getRepository('AppBundle:Article');
        $catRepo = $this->entityManager->getRepository('AppBundle:Cat');
        $cat = $catRepo->byId($catId );
        $art = new Article($name, $description, $cat);

        $artRepo->store($art);

        return $this->json($art, 200);
    }

    /**
     * @Route("/article/new", name="article_new_form")
     * @Method("GET")
     */
    public function getFormAction()
    {
        return $this->render("/create_article.html.twig");
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/article/delete/{id}", name="article_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
        $id = (int)$request->get('id');
        $artRepo = $this->entityManager->getRepository('AppBundle:Article');
        $art = $artRepo->byId($id);
        $art->setDeletedAt(new \DateTime());
        $artRepo->store($art);

        return $this->json([], 200);
    }



}