<?php
/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 01.04.18
 * Time: 16:03
 */

namespace AppBundle\Controller;
use AppBundle\Controller\ApiController;
use AppBundle\Entity\Cat;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Validator\Constraints\DateTime;


class CatController extends  ApiController
{
    /**
     * @Route("/cat", name="categories")
     */
    public function indexAction()
    {
        $catRepo = $this->entityManager->getRepository('AppBundle:Cat');
        $cat = $catRepo->all();

        return $this->json($cat, 200);
    }


    /**
     * @Route("/cat/new", name="category_new")
     * @Method("POST")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function createAction(Request $request)
    {
        $name = $request->request->get('catName');

        $catRepo = $this->entityManager->getRepository('AppBundle:Cat');
        $cat = new Cat($name);

        $catRepo->store($cat);

        return $this->json($cat, 200);
    }

    /**
     * @Route("/cat/new", name="category_new_form")
     * @Method("GET")
     */
    public function getFormAction()
    {
        return $this->render("AppBundle:Default:create_cat.html.twig");
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     * @Route("/cat/delete/{id}", name="category_delete")
     * @Method("GET")
     */
    public function deleteAction(Request $request)
    {
        $id = (int)$request->get('id');
        $catRepo = $this->entityManager->getRepository('AppBundle:Cat');
        $cat = $catRepo->byId($id);
        $cat->setDeletedAt(new \DateTime());
        $catRepo->store($cat);

        return $this->json([], 200);
    }



}