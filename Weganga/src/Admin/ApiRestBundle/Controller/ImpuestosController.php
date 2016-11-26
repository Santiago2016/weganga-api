<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Impuestos;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ImpuestosController extends Controller
{
    public function getImpuestoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $impuestos = $em->getRepository('ApiRestBundle:Impuestos')->find($id);
        return array('taxs'=>$impuestos);
    }

    public function getImpuestosAction(){
        $em = $this->getDoctrine()->getManager();
        $impuestos = $em->getRepository('ApiRestBundle:Impuestos')->findAll();
        return array('taxs'=>$impuestos);
    }

    public function deleteImpuestoAction($id){
        $em = $this->getDoctrine()->getManager();
        $impuestos = $em->getRepository('ApiRestBundle:Impuestos')->find($id);
        $msg = 'Tax: '.$impuestos->getName();
        $em->remove($impuestos);
        $em->flush();
        return array($msg => 'deleted');
    }

    public function postImpuestoAction(Request $request){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $impuesto = new Impuestos();
        $impuesto->setName($json['name']);
        $impuesto->setDescription($json['description']);
        $impuesto->setTasaimpuesto($json['tasaimpuesto']);
        $em->persist($impuesto);
        $em->flush();
        return array('taxs' => $impuesto);
    }

    public function putImpuestoAction(Request $request, $id){
        $json = json_decode($request->getContent(),true);
        $em = $this->getDoctrine()->getManager();
        $impuesto = $em->getRepository('ApiRestBundle:Impuestos')->find($id);
        $impuesto->setName($json['name']);
        $impuesto->setDescription($json['description']);
        $impuesto->setTasaimpuesto($json['tasaimpuesto']);
        $em->persist($impuesto);
        $em->flush();
        return array('taxs' => $impuesto);
    }

}
