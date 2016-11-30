<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Shopcars;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShopcarsController extends Controller
{
    public function getShopcarAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $shopcars = $em->getRepository('ApiRestBundle:Shopcars')->find($id);
        return array('shopcars'=>$shopcars);
    }

    public function getShopcarsAction(){
        $em = $this->getDoctrine()->getManager();
        $shopcars = $em->getRepository('ApiRestBundle:Shopcars')->findAll();
        return array('shopcars'=>$shopcars);
    }

    public function deleteShopcarAction($id){
        $em = $this->getDoctrine()->getManager();
        $shopcars = $em->getRepository('ApiRestBundle:Shopcars')->find($id);
        $msg = 'Shopcar: '.$shopcars->getName();
        $em->remove($shopcars);
        $em->flush();
        return array($msg => 'deleted');
    }

    public function postShopcarAction(Request $request){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $shopcar = new Shopcars();
        $shopcar->setName($json['name']);
        $shopcar->setDescription($json['description']);
        $em->persist($shopcar);
        $em->flush();
        return array('shopcars' => $shopcar);
    }
    public function putShopcarAction(Request $request, $id){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $shopcars = $em->getRepository('ApiRestBundle:Shopcars')->find($id);
        $shopcars->setName($json['name']);
        $shopcars->setDescription($json['description']);
        $em->persist($shopcars);
        $em->flush();
        return array('shopcars' => $shopcars);
    }
}
