<?php

namespace Admin\ApiRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Admin\ApiRestBundle\Entity\Users;


class UsersController extends Controller
{
    public function getUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->find($id);
        return array('user' => $users);
    }

    public function getUsersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->findAll();
        return array('users' => $users);
    }

    public function deleteUserAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->find($id);
        $em->remove($users);
        $em->flush();
        return array($users);
    }

    public function postUserAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $users = new Users();
        $encoder = $this->get('security.encoder_factory')->getEncoder($users);
        $users->setUsername($json['username']);
        $users->setPassword($encoder->encodePassword($json['password'], ''));
        $users->setRole($json['role']);
        $users->setNombre($json['nombre']);
        $users->setApellidos($json['apellidos']);
        $users->setDireccion($json['direccion']);
        $users->setEmail($json['email']);
        $users->setTelefono($json['telefono']);
        $users->setCodigopostal($json['codigopostal']);
        $em->persist($users);
        $em->flush();
        //enviar el username y el password por sms
        return array('users' => $users);
    }

    public function putUserAction($id, Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->find($id);
        $encoder = $this->get('security.encoder_factory')->getEncoder($users);
        $users->setUsername($json['username']);
        $users->setPassword($encoder->encodePassword($json['password'], ''));
        $users->setRole($json['role']);
        $users->setNombre($json['nombre']);
        $users->setApellidos($json['apellidos']);
        $users->setDireccion($json['direccion']);
        $users->setEmail($json['email']);
        $users->setTelefono($json['telefono']);
//        $users->setCodigopostal($json['codigopostal']);
        $em->persist($users);
        $em->flush();
        return array('users' => $users);
    }
}
