<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Requests;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RequestsController extends Controller
{
    public function getRequestAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $requests = $em->getRepository('ApiRestBundle:Requests')->findRequestsById($id);
        return array('request'=>$requests);
    }

    public function getRequestsAction(){
        $em = $this->getDoctrine()->getManager();
        $requests = $em->getRepository('ApiRestBundle:Requests')->findAllRequests();
        return array('requests'=>$requests);
    }

    public function deleteRequestAction($id){
        $em = $this->getDoctrine()->getManager();
        $requests = $em->getRepository('ApiRestBundle:Requests')->find($id);
        $msg = 'Request: '.$requests->getDate();
        $em->remove($requests);
        $em->flush();
        return array($msg => 'deleted');
    }

    public function postRequestAction(Request $request){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $requests = new Requests();
        $requests->setDate($json['name']);
        $requests->setDescription($json['description']);
        $requests->setQuantity($json['quantity']);
        $em->persist($requests);
        $em->flush();
        return array('Request: '.$json['name'] => 'posted');
    }

    public function putRequestAction(Request $request, $id){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $requests = $em->getRepository('ApiRestBundle:Requests')->find($id);
        $requests->setDate($json['name']);
        $requests->setDescription($json['description']);
        $requests->setQuantity($json['quantity']);
        $em->persist($requests);
        $em->flush();
        return array('Request: '.$json['name']=>'updated');
    }
}
