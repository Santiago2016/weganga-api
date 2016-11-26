<?php

namespace Admin\ApiRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Admin\ApiRestBundle\Entity\Administrators;

class AdministratorsController extends Controller
{
    public function getAdministratorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $administrators = $em->getRepository('ApiRestBundle:Administrators')->find($id);
        return array('administrators' => $administrators);
    }

    public function getAdministratorsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $administrators = $em->getRepository('ApiRestBundle:Administrators')->findAll();
        return array('administrators' => $administrators);
    }

    public function deleteAdministratorAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $administrators = $em->getRepository('ApiRestBundle:Administrators')->find($id);
        $em->remove($administrators);
        $em->flush();
        return array('administrators' => 'deleted');
    }

    public function postAdministratorAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $administrators = new Administrators();
        $encoder = $this->get('security.encoder_factory')->getEncoder($administrators);
        $administrators->setNombre($json['name']);
        $administrators->setApellidos($json['lastname']);
        $administrators->setDireccion($json['address']);
        $administrators->setCodigopostal($json['code']);
        $administrators->setEmail($json['email']);
        $administrators->setTelefono($json['phone']);
        $administrators->setUsername($json['username']);
        $administrators->setPassword($encoder->encodePassword($json['password'], ''));
        $administrators->setRole($json['role']);
        $em->persist($administrators);
        $em->flush();
        //enviar el username y el password por sms
        return array('administrators' => $administrators);
    }

    public function putAdministratorAction($id, Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $administrators = $em->getRepository('ApiRestBundle:Administrators')->find($id);
        $encoder = $this->get('security.encoder_factory')->getEncoder($administrators);
        $administrators->setNombre($json['name']);
        $administrators->setApellidos($json['lastname']);
        $administrators->setDireccion($json['address']);
        $administrators->setCodigopostal($json['code']);
        $administrators->setEmail($json['email']);
        $administrators->setTelefono($json['phone']);
        $administrators->setUsername($json['username']);
        $administrators->setPassword($encoder->encodePassword($json['password'], ''));
        $administrators->setRole($json['role']);
        $em->persist($administrators);
        $em->flush();
        return array('administrators' => $administrators);
    }
}
