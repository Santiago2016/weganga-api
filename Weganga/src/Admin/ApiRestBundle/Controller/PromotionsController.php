<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Promotions;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PromotionsController extends Controller
{
    public function getPromotionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $promotions = $em->getRepository('ApiRestBundle:Promotions')->find($id);
        return array('promotions' => $promotions);
    }

    public function getPromotionsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $promotions = $em->getRepository('ApiRestBundle:Promotions')->findAll();
        return array('promotions' => $promotions);
    }

    public function deletePromotionAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $promotions = $em->getRepository('ApiRestBundle:Promotions')->find($id);
        $msg = 'Promotion: ' . $promotions->getName();
        $em->remove($promotions);
        $em->flush();
        return array($msg => 'deleted');
    }

    public function postPromotionAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $promotion = new Promotions();
        $promotion->setName($json['name']);
        $promotion->setDesciption($json['description']);
        $em->persist($promotion);
        $em->flush();
        return array('promotions' => $promotion);
    }

    public function putPromotionAction(Request $request, $id)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $promotion = $em->getRepository('ApiRestBundle:Promotions')->find($id);
        $promotion->setName($json['name']);
        $promotion->setDesciption($json['description']);
        $em->persist($promotion);
        $em->flush();
        return array('promotions' => $promotion);
    }
}
