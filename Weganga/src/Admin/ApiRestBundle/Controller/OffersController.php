<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Offers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OffersController extends Controller
{
    public function getOfferAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('ApiRestBundle:Offers')->find($id);
        return array('offer'=>$offers);
    }

    public function getOffersAction(){
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('ApiRestBundle:Offers')->findAll();
        return array('offers'=>$offers);
    }

    public function deleteOfferAction($id){
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('ApiRestBundle:Offers')->find($id);
        $msg = 'Offer: '.$offers->getName();
        $em->remove($offers);
        $em->flush();
        return array($msg => 'deleted');
    }

    public function postOfferAction(Request $request){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $offer = new Offers();
        $date = new \DateTime($json['date']);
        $enddate = new \DateTime($json['enddate']);
        $offer->setName($json['name']);
        $offer->setCantrequest($json['cantrequest']);
        $offer->setConditions($json['conditions']);
        $offer->setDate($date);
        $offer->setDescuento($json['descuento']);
        $offer->setCost($json['cost']);
        $offer->setEnddate($enddate);
        $offer->setMoreinfo($json['moreinfo']);
        $offer->setPeriod($json['period']);
        $offer->setPlace($json['place']);
        $offer->setDescription($json['description']);
        $em->persist($offer);
        $em->flush();
        return array('offers' => $offer);
    }

    public function putOfferAction(Request $request, $id){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository('ApiRestBundle:Offers')->find($id);
        $date = new \DateTime($json['date']);
        $duration = new \DateTime($json['duration']);
        $offer->setName($json['name']);
        $offer->setCantrequest($json['buyers']);
        $offer->setConditions($json['conditions']);
        $offer->setDate($date);
        $offer->setDescuento($json['descuento']);
        $offer->setCost($json['location']);
        $offer->setEnddate($duration);
        $offer->setMoreinfo($json['moreinfo']);
        $offer->setPeriod($json['period']);
        $offer->setPlace($json['place']);
        $offer->setDescription($json['description']);
        $em->persist($offer);
        $em->flush();
        return array('Offer: '.$json['name']=>'updated');
    }
}
