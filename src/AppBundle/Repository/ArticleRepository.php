<?php

/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 01.04.18
 * Time: 16:51
 */
namespace AppBundle\Repository;

use AppBundle\Entity\Article;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class ArticleRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function all(){
        $builder = $this->createQueryBuilder('a')
            ->where('a.deletedAt is NULL');
        
        return $builder->getQuery()->getArrayResult();
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function byId($id){
        $builder = $this->createQueryBuilder('a')
            ->where('a.deletedAt is NULL')
            ->andWhere('a.id=:id')
            ->setParameter('id',$id);
        return $builder->getQuery()->getSingleResult();
    }

//    /**
//     * @param $id
//     * @return mixed
//     * @throws \Doctrine\ORM\NoResultException
//     * @throws \Doctrine\ORM\NonUniqueResultException
//     */
//    public function byCategoryId($id){
//        $builder = $this->createQueryBuilder('a')
//            ->where('a.deletedAt is NULL')
//            ->andWhere('a.id=:id')
//            ->setParameter('id',$id);
//        return $builder->getQuery()->getSingleResult();
//    }

    /**
     * @param Article $article
     */
    public function delete(Article $article){
        $article->setDeletedAt(new \DateTime());
    }

    

    /**
     * @param Article $article
     */
    public function store(Article $article)
    {
        $this->_em->persist($article);
        $this->_em->flush($article);
    }

}