<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Sales;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SalesController extends Controller
{
    public function getSaleAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $sales = $em->getRepository('ApiRestBundle:Sales')->find($id);
        return array('sales'=>$sales);
    }

    public function getSalesAction(){
        $em = $this->getDoctrine()->getManager();
        $sales = $em->getRepository('ApiRestBundle:Sales')->findAll();
        return array('sales'=>$sales);
    }

    public function deleteSaleAction($id){
        $em = $this->getDoctrine()->getManager();
        $sales = $em->getRepository('ApiRestBundle:Sales')->find($id);
        $msg = 'Sale: '.$sales->getDelivery();
        $em->remove($sales);
        $em->flush();
        return array($msg => 'deleted');
    }

    public function postSaleAction(Request $request){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $sale = new Sales();
        $date = new \DateTime($json['date']);
        $sale->setDelivery($json['delivery']);
        $sale->setClient($json['client']);
        $sale->setOffer($json['offer']);
        $sale->setDate($date);
        $sale->setQuantity($json['quantity']);
        $em->persist($sale);
        $em->flush();
        return array('sales' => $sale);
    }

    public function putSaleAction(Request $request, $id){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $sale = $em->getRepository('ApiRestBundle:Sales')->find($id);
        $date = new \DateTime($json['date']);
        $sale->setDelivery($json['delivery']);
        $sale->setDate($date);
        $sale->setQuantity($json['quantity']);
        $em->persist($sale);
        $em->flush();
        return array('sales' => $sale);
    }
}
