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
use Symfony\Component\Config\Definition\Exception\Exception;
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
        $artRepo = $this->entityManager->getRepository('AppBundle:Article');
        $art = $artRepo->all();

        return $this->json($art, 200);
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
        if(empty($cat)){
            return $this->json(['error'=>"Category with id {$catId} is not found!"], 400);
        }
        $art = new Article($name, $description, $cat);

        $artRepo->store($art);

        return $this->json(['message'=>"Article with name {$art->getName()} has been successfully created!"], 200);
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
        if(empty($art)){
            return $this->json(['error'=>"Article with id {$id} is not found!"], 404);
        }
        $art->setDeletedAt(new \DateTime());
        $artRepo->store($art);

        return $this->json(['message'=>'Article '.$art->getName().'has been successfully deleted'], 200);
    }

    /**
     * @Route("/articles/cat/{id}", name="articles_by_cat", requirements={"id": "\d+"})
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function byCatAction(Request $request)
    {
        $catId = !empty($request->get('id')) ? $request->get('id') : 0;
        $catRepo = $this->entityManager->getRepository('AppBundle:Cat');
        $cat = $catRepo->byId($catId);


        if(empty($cat)){
            return $this->json(['error'=>"Category with id {$catId} is not found!"], 404);
        }
        $artRepo = $this->entityManager->getRepository('AppBundle:Article');
        $arts = $artRepo->byCategoryId($catId);

        return $this->json($arts, 200);
    }

    /**
     * @param Request $request
     * @Route("/articles/edit/{id}", name="articles_edit", requirements={"id": "\d+"})
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function editAction(Request $request)
    {
        $newCatId = !empty($request->request->get('catId')) ? $request->request->get('catId') : 0;
        $newName = $request->request->get('name') ? $request->request->get('name') : 0;
        $newDescr = $request->request->get('description') ? $request->request->get('description') : 0;

        $artId = !empty($request->get('id')) ? $request->get('id') : 0;

        $artRepo = $this->entityManager->getRepository('AppBundle:Article');
        $art = $artRepo->byId($artId);
        
        if(empty($art)){
            return $this->json(['error'=>"Article with id {$artId} is not found!"], 404);
        }
        if(!empty($newCatId)){
            $catRepo = $this->entityManager->getRepository('AppBundle:Cat');
            $cat = $catRepo->byId($newCatId);
            if(!empty($cat)){
                $art->setCat($cat);
            }else{
                return $this->json(['error'=>"Category with {$newCatId} is not found!"], 404);
            }
        }
        if(!empty($newName)){
            $art->setName($newName);
        }
        if(!empty($newDescr)){
            $art->setDescription($newDescr);
        }
        
        $artRepo->store($art);

        return $this->json(['message'=>"Article with id = {$art->getId()} has been successfully updated"], 200);
    }


    /**
     * @Route("/articles/edit/{id}", name="articles_edit_form", requirements={"id": "\d+"})
     * @Method("GET")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function getEditFormAction(Request $request)
    {
        $artId = !empty($request->get('id')) ? $request->get('id') : 0;

        $artRepo = $this->entityManager->getRepository('AppBundle:Article');
        $art = $artRepo->byId($artId);

        if(empty($art)){
            return $this->json(['error'=>"Article with id {$artId} is not found!"], 404);
        }
        return $this->render("/edit_article.html.twig", ['art'=>$art]);
    }
    
}