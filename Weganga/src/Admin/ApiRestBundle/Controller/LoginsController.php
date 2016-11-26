<?php

namespace Admin\ApiRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Admin\ApiRestBundle\Entity\Users;

class LoginsController extends FOSRestController
{
    public function loginUserAction(Request $request){
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->findAll();
        $user = new Users();
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $user->setUsername($json['username']);
        $user->setPassword($encoder->encodePassword($json['password'],''));
        foreach ($users as $u){
            if ($user->equals($u)){
                if ($u->getRole() == 'ROLE_ADMIN'){
                    $administrator = $em->getRepository('ApiRestBundle:Administrators')->find($u->getId());
                    return array("user" => $administrator);
                } elseif ($u->getRole() == 'ROLE_VENDEDOR'){
                    $provider = $em->getRepository('ApiRestBundle:Providers')->find($u->getId());
                    return array("user" => $provider);
                } else {
                    $client = $em->getRepository('ApiRestBundle:Clients')->find($u->getId());
                    return array("user" => $client);
                }
            }
        }
        return array("user" => null);
    }

    public function forgotAction(Request $request){
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->findOneBy(array('username'=>$json['username'],'nombre'=>$json['nombre'],'apellidos'=>$json['apellidos'],'email'=>$json['email']));
        if ($users != null){
            $encoder = $this->get('security.encoder_factory')->getEncoder($users);
            $users->setPassword($encoder->encodePassword($json['username'],''));
            $em->persist($users);
            $em->flush();
            //mandar el password nuevo por email o sms
            return array("status"=>"success");
        }
        return array("status"=>"failed");
    }

    public function logoutUserAction(Request $request){
        return array("message" => "Loggged out");
    }

    public function updateUserAction(Request $request){
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->find($json['id']);
        $users->setUsername($json['username']);
        $users->setRole($json['role']);
        $users->setNombre($json['nombre']);
        $users->setApellidos($json['apellidos']);
        $users->setDireccion($json['direccion']);
        $users->setEmail($json['email']);
        $users->setTelefono($json['telefono']);
        $em->persist($users);
        $em->flush();
        return array($users);
    }
}
