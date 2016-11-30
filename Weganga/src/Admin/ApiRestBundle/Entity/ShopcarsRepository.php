<?php
/**
 * Created by PhpStorm.
 * User: Camilo
 * Date: 02/11/2016
 * Time: 4:50:39 PM
 */

namespace Admin\ApiRestBundle\Entity;

use Doctrine\ORM\EntityRepository;

class ShopcarsRepository extends EntityRepository
{
    public function findShopcarsById($id){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT u FROM ApiRestBundle:Shopcars u WHERE u.id = :id");
        $query->setParameter('id',$id);
        return $query->getArrayResult();
    }

    public function findAllShopcars(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT u FROM ApiRestBundle:Shopcars u");
        return $query->getArrayResult();
    }
}