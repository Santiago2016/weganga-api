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
        $date = new \DateTime('now');
        $enddate = new \DateTime();
        $enddate->setDate($json['year'], $json['month'], $json['day']);
        $offer->setName($json['name']);
        $offer->setCantrequest(0);
        $offer->setConditions($json['conditions']);
        $offer->setDate($date);
        $offer->setDescuento(0);
        $offer->setCost($json['cost']);
        $offer->setEnddate($enddate);
        $offer->setMoreinfo($json['moreinfo']);
//        $offer->setPeriod($json['period']);
        $offer->setPlace($json['place']);
        $offer->setDescription($json['description']);
        if ($json['rebaja1'] != null){
            $offer->setRebaja1($json['rebaja1']);
        }
        if ($json['rebaja2'] != null){
            $offer->setRebaja2($json['rebaja2']);
        }
        if ($json['rebaja3'] != null){
            $offer->setRebaja3($json['rebaja3']);
        }
        if ($json['rebaja4'] != null){
            $offer->setRebaja4($json['rebaja4']);
        }
        if ($json['rebaja5'] != null){
            $offer->setRebaja5($json['rebaja5']);
        }
        if ($json['rebaja6'] != null){
            $offer->setRebaja6($json['rebaja6']);
        }
        if ($json['rebaja7'] != null){
            $offer->setRebaja7($json['rebaja7']);
        }
        if ($json['rebaja8'] != null){
            $offer->setRebaja8($json['rebaja8']);
        }
        if ($json['rebaja9'] != null){
            $offer->setRebaja9($json['rebaja9']);
        }
        if ($json['rebaja10'] != null){
            $offer->setRebaja10($json['rebaja10']);
        }
        $provider = $em->getRepository('ApiRestBundle:Providers')->find($json['provider']);
        $offer->setProvider($provider);
        $offer->setEstado("PENDIENTE");
        $em->persist($offer);
        $em->flush();
        foreach ($json['categorias'] as $cat){
            $categoria = $em->getRepository('ApiRestBundle:Categorys')->find($cat);
            $offer->addCategory($categoria);
            $categoria->addOffer($offer);
            $em->persist($categoria);
            $em->flush();
            $em->persist($offer);
            $em->flush();
        }        
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
