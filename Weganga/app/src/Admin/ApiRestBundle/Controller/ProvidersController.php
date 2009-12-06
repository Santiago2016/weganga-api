<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Providers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProvidersController extends Controller
{

    public function getProviderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $providers = $em->getRepository('ApiRestBundle:Providers')->find($id);
        return array('providers' => $providers);
    }

    public function getProvidersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $providers = $em->getRepository('ApiRestBundle:Providers')->findAll();
        return array('providers' => $providers);
    }

    public function deleteProviderAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $providers = $em->getRepository('ApiRestBundle:Providers')->find($id);
        $em->remove($providers);
        $em->flush();
        return array('providers' => 'deleted');
    }

    public function postProviderAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $providers = new Providers();
        $encoder = $this->get('security.encoder_factory')->getEncoder($providers);
        $providers->setNombre($json['name']);
        $providers->setApellidos($json['lastname']);
        $providers->setDireccion($json['address']);
        $providers->setCodigopostal($json['code']);
        $providers->setDni($json['dni']);
        $providers->setEmail($json['email']);
        $providers->setTelefono($json['phone']);
        $providers->setUsername($json['email']);
        $providers->setPassword($encoder->encodePassword($json['phone'], ''));
        $providers->setRole('ROLE_VENDEDOR');
        $em->persist($providers);
        $em->flush();
        //enviar el username y el password por sms
        return array('providers' => $providers);
    }

    public function putProviderAction($id, Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $providers = $em->getRepository('ApiRestBundle:Providers')->find($id);
        $providers->setNombre($json['name']);
        $providers->setApellidos($json['lastname']);
        $providers->setDireccion($json['address']);
        $providers->setDni($json['dni']);
        $providers->setEmail($json['email']);
        $providers->setTelefono($json['phone']);
        $em->persist($providers);
        $em->flush();
        return array('providers' => $providers);
    }
}
