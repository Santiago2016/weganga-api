<?php

namespace Admin\ApiRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Admin\ApiRestBundle\Entity\Clients;
use FOS\RestBundle\Controller\FOSRestController;

class ClientsController extends FOSRestController
{
    public function getClientAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('ApiRestBundle:Clients')->find($id);
        return array('clients' => $clients);
    }

    public function getClientsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('ApiRestBundle:Clients')->findAll();
        return array('clients' => $clients);
    }

    public function deleteClientAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('ApiRestBundle:Clients')->find($id);
        $em->remove($clients);
        $em->flush();
        return array('clients' => 'deleted');
    }

    public function postClientAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $clients = new Clients();
        $encoder = $this->get('security.encoder_factory')->getEncoder($clients);
        $clients->setNombre($json['name']);
        $clients->setApellidos($json['lastname']);
        $clients->setDireccion($json['address']);
        $clients->setCodigopostal($json['code']);
        $clients->setDni($json['dni']);
        $clients->setEmail($json['email']);
        $clients->setTelefono($json['phone']);
        $clients->setUsername($json['username']);
        $clients->setPassword($encoder->encodePassword($json['password'],''));
        $clients->setRole($json['role']);
        $em->persist($clients);
        $em->flush();
        //enviar el username y el password por sms
        return array('clients' => $clients);
    }

    public function putClientAction($id, Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $clients = $em->getRepository('ApiRestBundle:Clients')->find($id);
        $encoder = $this->get('security.encoder_factory')->getEncoder($clients);
        $clients->setNombre($json['name']);
        $clients->setApellidos($json['lastname']);
        $clients->setDireccion($json['address']);
        $clients->setCodigopostal($json['code']);
        $clients->setDni($json['dni']);
        $clients->setEmail($json['email']);
        $clients->setTelefono($json['phone']);
        $clients->setUsername($json['username']);
        $clients->setPassword($encoder->encodePassword($json['password'],''));
        $clients->setRole($json['role']);
        $em->persist($clients);
        $em->flush();
        return array('clients' => $clients);
    }
}
