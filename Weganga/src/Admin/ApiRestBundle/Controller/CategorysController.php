<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Categorys;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;

class CategorysController extends Controller
{
    public function getCategoriaAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('ApiRestBundle:Categorys')->find($id);
        return array('categorys' => $category);
    }

    public function getCategoriasAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categorys = $em->getRepository('ApiRestBundle:Categorys')->findAll();
        return array('categorys' => $categorys);
    }

    public function deleteCategoriaAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorys = $em->getRepository('ApiRestBundle:Categorys')->find($id);
        $em->remove($categorys);
        $em->flush();
        return array('categorys' => 'deleted');
    }

    public function postCategoriaAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $categorys = new Categorys();
        $categorys->setName($json['name']);
        $categorys->setDescription($json['description']);
        $user = $em->getRepository('ApiRestBundle:Users')->find($json['user']);
        $categorys->setUser($user);
        if ($user->getRole() == 'ROLE_ADMIN'){
            $categorys->setBorrable("NO");
        }else{
            $categorys->setBorrable("SI");
        }
        $em->persist($categorys);
        $em->flush();
        //enviar el username y el password por sms
        return array('categorys' => $categorys);
    }

    public function putCategoriaAction($id, Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $categorys = $em->getRepository('ApiRestBundle:Categorys')->find($id);
        $categorys->setName($json['name']);
        $categorys->setDescription($json['description']);
        $em->persist($categorys);
        $em->flush();
        return array('categorys' => $categorys);
    }
}
