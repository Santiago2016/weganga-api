<?php

namespace Admin\ApiRestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Admin\ApiRestBundle\Entity\Users;
use Admin\ApiRestBundle\Entity\Requests;

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
    
    public function filterproviderAction($valor){
        $em = $this->getDoctrine()->getManager();
        $providers = $em->getRepository('ApiRestBundle:Providers')->findAll();
        $filter = array();
        foreach ($providers as $p){
            if (strstr(strtolower($p->getNombre()), strtolower($valor)) != FALSE || strstr(strtolower($p->getApellidos()), strtolower($valor)) != FALSE || strstr(strtolower($p->getDireccion()), strtolower($valor)) != FALSE || strstr(strtolower($p->getTelefono()), strtolower($valor)) != FALSE || strstr(strtolower($p->getEmail()), strtolower($valor)) != FALSE || strstr(strtolower($p->getDni()), strtolower($valor)) != FALSE){
                $filter[] = $p;
            }
        }
        return array('providers' => $filter);
    }
    
    public function filterimpuestoAction($valor){
        $em = $this->getDoctrine()->getManager();
        $impuestos = $em->getRepository('ApiRestBundle:Impuestos')->findAll();
        $filter = array();
        foreach ($impuestos as $i){
            if (strstr(strtolower($i->getName()), strtolower($valor)) != FALSE || strstr(strtolower($i->getDescription()), strtolower($valor)) != FALSE){
                $filter[] = $i;
            }
        }
        return array('taxs' => $filter);
    }
    
    public function filterofferAction($valor){
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('ApiRestBundle:Offers')->findAll();
        $filter = array();
        foreach ($offers as $o){
            if (strstr(strtolower($o->getName()), strtolower($valor)) != FALSE){
                $filter[] = $o;
            }
        }
        return array('offers' => $filter);
    }
    
    public function filtershopcarAction($valor){
        $em = $this->getDoctrine()->getManager();
        $shopcars = $em->getRepository('ApiRestBundle:Shopcars')->findAll();
        $filter = array();
        foreach ($shopcars as $s){
            if (strstr(strtolower($s->getName()), strtolower($valor)) != FALSE || strstr(strtolower($s->getDescription()), strtolower($valor)) != FALSE){
                $filter[] = $s;
            }
        }
        return array('shopcars' => $filter);
    }
    
    public function filterpromotionAction($valor){
        $em = $this->getDoctrine()->getManager();
        $promotions = $em->getRepository('ApiRestBundle:Promotions')->findAll();
        $filter = array();
        foreach ($promotions as $p){
            if (strstr(strtolower($p->getName()), strtolower($valor)) != FALSE || strstr(strtolower($p->getDesciption()), strtolower($valor)) != FALSE){
                $filter[] = $p;
            }
        }
        return array('promotions' => $filter);
    }
    
    public function filtersaleAction($valor){
        $em = $this->getDoctrine()->getManager();
        $sales = $em->getRepository('ApiRestBundle:Sales')->findAll();
        $filter = array();
        foreach ($sales as $s){
            if (strstr(strtolower($s->getOffer()->getName()), strtolower($valor)) != FALSE || strstr(strtolower($s->getClient()), strtolower($valor)) != FALSE || strstr(strtolower($s->getOffer()->getProvider()), strtolower($valor)) != FALSE){
                $filter[] = $s;
            }
        }
        return array('sales' => $filter);
    }
    
    public function filteruserAction($valor){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->findAll();
        $filter = array();
        foreach ($users as $u){
            if (strstr(strtolower($u->getNombre()), strtolower($valor)) != FALSE || strstr(strtolower($u->getApellidos()), strtolower($valor)) != FALSE || strstr(strtolower($u->getDireccion()), strtolower($valor)) != FALSE || strstr(strtolower($u->getTelefono()), strtolower($valor)) != FALSE || strstr(strtolower($u->getEmail()), strtolower($valor)) != FALSE){
                $filter[] = $u;
            }
        }
        return array('users' => $filter);
    }
    
    public function filtercategoriaAction($valor){
        $em = $this->getDoctrine()->getManager();
        $categorys = $em->getRepository('ApiRestBundle:Categorys')->findAll();
        $filter = array();
        foreach ($categorys as $c){
            if (strstr(strtolower($c->getName()), strtolower($valor)) != FALSE || strstr(strtolower($c->getDescription()), strtolower($valor)) != FALSE){
                $filter[] = $c;
            }
        }
        return array('categorys' => $filter);
    }
    
    public function aprobarofertaAction($id){
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('ApiRestBundle:Offers')->find($id);
        $oferta->setEstado("APROBADA");
        $em->persist($oferta);
        $em->flush();
        return array('status' => 'success');
    }
    
    public function usuariofilterAction($valor){
        $retorno = array();
        $em = $this->getDoctrine()->getManager();
        $categorys = $em->getRepository('ApiRestBundle:Categorys')->findAll();
        foreach ($categorys as $c){
            if ($c->getName() == $valor){
                foreach ($c->getOffers() as $o){
                    $retorno[] = $o;
                }
            }
        }
        $ofertas = $em->getRepository('ApiRestBundle:Offers')->findAll();
        foreach ($ofertas as $o){
            if (strstr(strtolower($o->getName()), strtolower($valor)) && !$this->contiene($retorno, $o)){
                $retorno[] = $o;
            }
        }
        return array('offers' => $retorno);
    }
    
    public function contiene($arreglo, $oferta){
        foreach ($arreglo as $a){
            if ($a->getName() == $oferta->getName()){
                return true;
            }
        }
        return false;
    }
    
    public function apuntarseAction(Request $request){
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('ApiRestBundle:Clients')->findOneBy(array('username' => $json['client']));
        $oferta = $em->getRepository('ApiRestBundle:Offers')->find($json['oferta']);
        $requested = new Requests();
        $date = new \DateTime('now');
        $requested->setClient($client);
        $requested->setDate($date);
        $requested->setOffer($oferta);
        $requested->setQuantity(1);
        $em->persist($requested);
        $em->flush();
        $client->addRequest($requested);
        $em->persist($client);
        $em->flush();
        return array('status' => 'success');
    }
    
    public function desearAction(Request $request){
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('ApiRestBundle:Clients')->findOneBy(array('username' => $json['client']));
        $oferta = $em->getRepository('ApiRestBundle:Offers')->find($json['oferta']);
        $client->addListofwish($oferta);
        $em->persist($client);
        $em->flush();
        $oferta->addClient($client);
        $em->persist($oferta);
        $em->flush();
        return array('status' => 'success');
    }
}
