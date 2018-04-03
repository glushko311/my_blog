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
use \Doctrine\ORM\NoResultException;

class ArticleRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function all(){
        $builder = $this->createQueryBuilder('a')
            ->where('a.deletedAt is NULL')
            ->join('a.cat', 'c');
        
        return $builder->getQuery()->getResult();
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
            ->join('a.cat', 'c')
            ->setParameter('id',$id);

        try{
            $art = $builder->getQuery()->getSingleResult();
        }catch(NoResultException $e){
            return null;
        }
        return  $art;
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function byCategoryId($id){
        $builder = $this->createQueryBuilder('a')
            ->join('a.cat', 'c')
            ->where('a.deletedAt is NULL')
            ->andWhere('c.id=:id')
            ->setParameter('id',$id);
        return $builder->getQuery()->getArrayResult();
    }

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