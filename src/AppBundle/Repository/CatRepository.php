<?php

/**
 * Created by PhpStorm.
 * User: vadim
 * Date: 01.04.18
 * Time: 16:51
 */
namespace AppBundle\Repository;

use AppBundle\Entity\Cat;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;

class CatRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function all(){
        $builder = $this->createQueryBuilder('c')
            ->where('c.deletedAt is NULL');
        
        return $builder->getQuery()->getArrayResult();
    }

    /**
     * @param $id
     * @return mixed
     * @throws \Doctrine\ORM\NoResultException
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function byId($id){
        $builder = $this->createQueryBuilder('c')
            ->where('c.deletedAt is NULL')
            ->andWhere('c.id=:id')
            ->setParameter('id',$id);
        return $builder->getQuery()->getSingleResult();
    }

    /**
     * @param Cat $cat
     */
    public function delete(Cat $cat){
        $cat->setDeletedAt(new \DateTime());
    }
    
    /**
     * @param Cat $cat
     */
    public function store(Cat $cat)
    {
        $this->_em->persist($cat);
        $this->_em->flush($cat);
    }
    
}