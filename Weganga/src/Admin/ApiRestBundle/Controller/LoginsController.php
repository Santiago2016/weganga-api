<?php

namespace Admin\ApiRestBundle\Controller;

use Admin\ApiRestBundle\Entity\Offers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\FOSRestController;
use Admin\ApiRestBundle\Entity\Users;
use Admin\ApiRestBundle\Entity\Requests;

class LoginsController extends FOSRestController
{

    public function loginUserAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->findAll();
        $user = new Users();
        $encoder = $this->get('security.encoder_factory')->getEncoder($user);
        $user->setUsername($json['username']);
        $user->setPassword($encoder->encodePassword($json['password'], ''));
        foreach ($users as $u) {
            if ($user->equals($u)) {
                if ($u->getRole() == 'ROLE_ADMIN') {
                    $administrator = $em->getRepository('ApiRestBundle:Administrators')->find($u->getId());
                    $retorno = array("id" => $administrator->getId(), "username" => $administrator->getUsername(), "role" => $administrator->getRole());
                    return array("user" => $retorno);
                } elseif ($u->getRole() == 'ROLE_VENDEDOR') {
                    $provider = $em->getRepository('ApiRestBundle:Providers')->find($u->getId());
                    $retorno = array("id" => $provider->getId(), "username" => $provider->getUsername(), "role" => $provider->getRole());
                    return array("user" => $retorno);
                } else {
                    $client = $em->getRepository('ApiRestBundle:Clients')->find($u->getId());
                    $retorno = array("id" => $client->getId(), "username" => $client->getUsername(), "role" => $client->getRole());
                    return array("user" => $retorno);
                }
            }
        }
        return array("user" => null);
    }

    public function forgotAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->findOneBy(array('username' => $json['username'], 'nombre' => $json['nombre'], 'apellidos' => $json['apellidos'], 'email' => $json['email']));
        if ($users != null) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($users);
            $users->setPassword($encoder->encodePassword($json['username'], ''));
            $em->persist($users);
            $em->flush();
            //mandar el password nuevo por email o sms
            return array("status" => "success");
        }
        return array("status" => "failed");
    }

    public function logoutUserAction(Request $request)
    {
        return array("message" => "Loggged out");
    }

    public function updateUserAction(Request $request)
    {
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

    public function filterproviderAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $providers = $em->getRepository('ApiRestBundle:Providers')->findAll();
        $filter = array();
        foreach ($providers as $p) {
            if (strstr(strtolower($p->getNombre()), strtolower($valor)) != FALSE || strstr(strtolower($p->getApellidos()), strtolower($valor)) != FALSE || strstr(strtolower($p->getDireccion()), strtolower($valor)) != FALSE || strstr(strtolower($p->getTelefono()), strtolower($valor)) != FALSE || strstr(strtolower($p->getEmail()), strtolower($valor)) != FALSE || strstr(strtolower($p->getDni()), strtolower($valor)) != FALSE) {
                $filter[] = $p;
            }
        }
        return array('providers' => $filter);
    }

    public function filterimpuestoAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $impuestos = $em->getRepository('ApiRestBundle:Impuestos')->findAll();
        $filter = array();
        foreach ($impuestos as $i) {
            if (strstr(strtolower($i->getName()), strtolower($valor)) != FALSE || strstr(strtolower($i->getDescription()), strtolower($valor)) != FALSE) {
                $filter[] = $i;
            }
        }
        return array('taxs' => $filter);
    }

    public function filterofferAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('ApiRestBundle:Offers')->findAll();
        $filter = array();
        foreach ($offers as $o) {
            if (strstr(strtolower($o->getName()), strtolower($valor)) != FALSE) {
                $filter[] = $o;
            }
        }
        return array('offers' => $filter);
    }

    public function filtershopcarAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $shopcars = $em->getRepository('ApiRestBundle:Shopcars')->findAll();
        $filter = array();
        foreach ($shopcars as $s) {
            if (strstr(strtolower($s->getName()), strtolower($valor)) != FALSE || strstr(strtolower($s->getDescription()), strtolower($valor)) != FALSE) {
                $filter[] = $s;
            }
        }
        return array('shopcars' => $filter);
    }

    public function filterpromotionAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $promotions = $em->getRepository('ApiRestBundle:Promotions')->findAll();
        $filter = array();
        foreach ($promotions as $p) {
            if (strstr(strtolower($p->getName()), strtolower($valor)) != FALSE || strstr(strtolower($p->getDesciption()), strtolower($valor)) != FALSE) {
                $filter[] = $p;
            }
        }
        return array('promotions' => $filter);
    }

    public function filtersaleAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $sales = $em->getRepository('ApiRestBundle:Sales')->findAll();
        $filter = array();
        foreach ($sales as $s) {
            if (strstr(strtolower($s->getOffer()->getName()), strtolower($valor)) != FALSE || strstr(strtolower($s->getClient()), strtolower($valor)) != FALSE || strstr(strtolower($s->getOffer()->getProvider()), strtolower($valor)) != FALSE) {
                $filter[] = $s;
            }
        }
        return array('sales' => $filter);
    }

    public function filteruserAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ApiRestBundle:Users')->findAll();
        $filter = array();
        foreach ($users as $u) {
            if (strstr(strtolower($u->getNombre()), strtolower($valor)) != FALSE || strstr(strtolower($u->getApellidos()), strtolower($valor)) != FALSE || strstr(strtolower($u->getDireccion()), strtolower($valor)) != FALSE || strstr(strtolower($u->getTelefono()), strtolower($valor)) != FALSE || strstr(strtolower($u->getEmail()), strtolower($valor)) != FALSE) {
                $filter[] = $u;
            }
        }
        return array('users' => $filter);
    }

    public function filtercategoriaAction($valor)
    {
        $em = $this->getDoctrine()->getManager();
        $categorys = $em->getRepository('ApiRestBundle:Categorys')->findAll();
        $filter = array();
        foreach ($categorys as $c) {
            if (strstr(strtolower($c->getName()), strtolower($valor)) != FALSE || strstr(strtolower($c->getDescription()), strtolower($valor)) != FALSE) {
                $filter[] = $c;
            }
        }
        return array('categorys' => $filter);
    }

    public function aprobarofertaAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('ApiRestBundle:Offers')->find($id);
        $oferta->setEstado("APROBADA");
        $em->persist($oferta);
        $em->flush();
        return array('status' => 'success');
    }

    public function usuariofilterAction($valor)
    {
        $retorno = array();
        $em = $this->getDoctrine()->getManager();
        $categorys = $em->getRepository('ApiRestBundle:Categorys')->findAll();
        foreach ($categorys as $c) {
            if ($c->getName() == $valor) {
                foreach ($c->getOffers() as $o) {
                    $retorno[] = $o;
                }
            }
        }
        $ofertas = $em->getRepository('ApiRestBundle:Offers')->findAll();
        foreach ($ofertas as $o) {
            if (strstr(strtolower($o->getName()), strtolower($valor)) && !$this->contiene($retorno, $o)) {
                $retorno[] = $o;
            }
        }
        return array('offers' => $retorno);
    }

    public function contiene($arreglo, $oferta)
    {
        foreach ($arreglo as $a) {
            if ($a->getName() == $oferta->getName()) {
                return true;
            }
        }
        return false;
    }

    public function apuntarseAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('ApiRestBundle:Clients')->findOneBy(array('username' => $json['client']));
        $oferta = $em->getRepository('ApiRestBundle:Offers')->find($json['oferta']);
        $requested = new Requests();
        $date = new \DateTime('now');
        $requested->setClient($client);
        $requested->setDate($date);
        $requested->setOffer($oferta);
        $requested->setQuantity($json['cantidad']);
        $em->persist($requested);
        $em->flush();
        $client->addRequest($requested);
        $em->persist($client);
        $em->flush();
        $cantidadvieja = $oferta->getCantrequest();
        $oferta->setCantrequest($oferta->getCantrequest() + $json['cantidad']);
        if ($oferta->getCantrequest() >= 2501) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja10());
        } elseif ($oferta->getCantrequest() >= 1001) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja9());
        } elseif ($oferta->getCantrequest() >= 501) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja8());
        } elseif ($oferta->getCantrequest() >= 251) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja7());
        } elseif ($oferta->getCantrequest() >= 101) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja6());
        } elseif ($oferta->getCantrequest() >= 51) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja5());
        } elseif ($oferta->getCantrequest() >= 26) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja4());
        } elseif ($oferta->getCantrequest() >= 11) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja3());
        } elseif ($oferta->getCantrequest() >= 6) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja2());
        } elseif ($oferta->getCantrequest() >= 1) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja1());
        }
        if ($oferta->getCantrequest() < 6) {
            $oferta->setFaltan(6 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 11) {
            $oferta->setFaltan(11 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 26) {
            $oferta->setFaltan(26 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 51) {
            $oferta->setFaltan(51 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 101) {
            $oferta->setFaltan(101 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 251) {
            $oferta->setFaltan(251 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 501) {
            $oferta->setFaltan(501 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 1001) {
            $oferta->setFaltan(1001 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 2501) {
            $oferta->setFaltan(2501 - $oferta->getCantrequest());
        }
        $em->persist($oferta);
        $em->flush();
        return array('status' => 'success');
    }

    public function apuntarseeditarAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('ApiRestBundle:Clients')->findOneBy(array('username' => $json['client']));
        $oferta = $em->getRepository('ApiRestBundle:Offers')->find($json['oferta']);
        $requested = $em->getRepository('ApiRestBundle:Requests')->findOneBy(array('offer' => $oferta, 'client' => $client));
        $requested->setQuantity($requested->getQuantity() + $json['cantidad']);
        $em->persist($requested);
        $em->flush();
        $cantidadvieja = $oferta->getCantrequest();
        $oferta->setCantrequest($oferta->getCantrequest() + $json['cantidad']);
        if ($oferta->getCantrequest() >= 2501) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja10());
        } elseif ($oferta->getCantrequest() >= 1001) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja9());
        } elseif ($oferta->getCantrequest() >= 501) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja8());
        } elseif ($oferta->getCantrequest() >= 251) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja7());
        } elseif ($oferta->getCantrequest() >= 101) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja6());
        } elseif ($oferta->getCantrequest() >= 51) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja5());
        } elseif ($oferta->getCantrequest() >= 26) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja4());
        } elseif ($oferta->getCantrequest() >= 11) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja3());
        } elseif ($oferta->getCantrequest() >= 6) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja2());
        } elseif ($oferta->getCantrequest() >= 1) {
            $oferta->setDescuento($oferta->getCost() - $oferta->getRebaja1());
        }
        if ($oferta->getCantrequest() < 6) {
            $oferta->setFaltan(6 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 11) {
            $oferta->setFaltan(11 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 26) {
            $oferta->setFaltan(26 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 51) {
            $oferta->setFaltan(51 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 101) {
            $oferta->setFaltan(101 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 251) {
            $oferta->setFaltan(251 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 501) {
            $oferta->setFaltan(501 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 1001) {
            $oferta->setFaltan(1001 - $oferta->getCantrequest());
        } elseif ($oferta->getCantrequest() < 2501) {
            $oferta->setFaltan(2501 - $oferta->getCantrequest());
        }
        $em->persist($oferta);
        $em->flush();
        return array('status' => 'success');
    }

    public function desearAction(Request $request)
    {
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

    public function listadeseosAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $client = $em->getRepository('ApiRestBundle:Clients')->findOneBy(array('username' => $json['client']));
        $ofertas = $client->getListofwish();
        return array('offers' => $ofertas);
    }

    public function vendedorcategoriasAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApiRestBundle:Users')->find($json['usuario']);
        $categorys = $user->getCategorys();
        return array('categorys' => $categorys);
    }

    public function vendedorofertasAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApiRestBundle:Providers')->findOneBy(array("username" => $json['usuario']));
        $offers = $user->getOffers();
        return array('offers' => $offers);
    }

    public function proveedorofertasAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository('ApiRestBundle:Offers')->find($json['oferta']);
        $provider = $offer->getProvider();
        $offers = $provider->getOffers();
        $retorno = array();
        $hoy = new \DateTime('now');
        foreach ($offers as $o) {
            if ($hoy > $o->getDate() && $hoy < $o->getEnddate() && $o->getEstado() == "APROBADA") {
                $retorno[] = $o;
            }
        }
        return array('offers' => $retorno);
    }

    public function categoriaofertasAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $category = $em->getRepository('ApiRestBundle:Categorys')->findOneBy(array("name" => $json['category']));
        $offers = $category->getOffers();
        $retorno = array();
        $hoy = new \DateTime('now');
        foreach ($offers as $o) {
            if ($hoy > $o->getDate() && $hoy < $o->getEnddate() && $o->getEstado() == "APROBADA") {
                $retorno[] = $o;
            }
        }
        return array('offers' => $retorno);
    }

    public function ofertasdiaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('ApiRestBundle:Offers')->findAll();
        $hoy = new \DateTime('now');
        $retorno = array();
        foreach ($offers as $o) {
            if ($o->getDate()->format('Y-m-d') == $hoy->format('Y-m-d') && $o->getEstado() == "APROBADA") {
                $retorno[] = $o;
            }
        }
        return array('offers' => $retorno);
    }

    public function ofertasuserAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $offers = $em->getRepository('ApiRestBundle:Offers')->findAll();
        $retorno = array();
        $hoy = new \DateTime('now');
        foreach ($offers as $o) {
            if ($hoy > $o->getDate() && $hoy < $o->getEnddate() && $o->getEstado() == "APROBADA") {
                $retorno[] = $o;
            }
        }
        return array('offers' => $retorno);
    }

    public function ofertaverAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        if ($json['client'] != '') {
            $offer = $em->getRepository('ApiRestBundle:Offers')->find($json['offer']);
            $cliente = $em->getRepository('ApiRestBundle:Clients')->find($json['client']);
            $deseos = $cliente->getListofwish();
            $pedidos = $cliente->getRequests();
            $retorno = array();
            $retorno['offer'] = $offer;
            $retorno['apuntado'] = false;
            $retorno['deseado'] = false;
            foreach ($deseos as $d) {
                if ($d->getId() == $offer->getId()) {
                    $retorno['deseado'] = true;
                    break;
                }
            }
            foreach ($pedidos as $p) {
                if ($p->getOffer()->getId() == $offer->getId()) {
                    $retorno['apuntado'] = true;
                    $retorno['deseado'] = true;
                    break;
                }
            }
            return array('retorno' => $retorno);
        } else {
            $offer = $em->getRepository('ApiRestBundle:Offers')->find($json['offer']);
            $retorno = array();
            $retorno['offer'] = $offer;
            $retorno['apuntado'] = false;
            $retorno['deseado'] = false;
            return array('retorno' => $retorno);
        }
    }

    public function ofertasusuarioAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('ApiRestBundle:Clients')->findOneBy(array("username" => $json['usuario']));
        $pedidos = $user->getRequests();
        $retorno = array();
        foreach ($pedidos as $p) {
            $retorno[] = $p->getOffer();
        }
        return array('offers' => $retorno);
    }

    public function usuariosofertaAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $offer = $em->getRepository('ApiRestBundle:Offers')->find($json['oferta']);
        $pedidos = $offer->getRequests();
        $retorno = array();
        foreach ($pedidos as $p) {
            $retorno[] = $p->getClient();
        }
        return array('users' => $retorno);
    }

    public function cargamasivaAction(Request $request)
    {
        $json = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $xml = '<ofertas>
                    <oferta>
                        <date>2016-12-10 19:40:26</date>
                        <enddate>2017-03-10 19:40:26</enddate>
                        <name>Auriculares inhalambricos</name>
                        <conditions>Una serie de condiciones que marcan el comportamiento de la oferta a traves del tiempo</conditions>
                        <cost>24.90</cost>
                        <moreinfo>Todal la que quieras</moreinfo>
                        <place>Holguin</place>
                        <description>Una descripcion cualquiera sobre el producto</description>
                        <categorias>
                            <category>una categoria</category>
                            <category>otra categoria</category>
                        </categorias>
                        <rebaja1>24.20</rebaja1>
                        <rebaja2>23.50</rebaja2>
                        <rebaja3>22.60</rebaja3>
                        <rebaja4>21.50</rebaja4>
                        <rebaja5>20.20</rebaja5>
                        <rebaja6>19.10</rebaja6>
                        <rebaja7>17.90</rebaja7>
                        <rebaja8>16.70</rebaja8>
                        <rebaja9>15.40</rebaja9>
                        <rebaja10>14.10</rebaja10>
                    </oferta>
                    <oferta>
                        <date>2016-12-10 19:40:26</date>
                        <enddate>2017-03-10 19:40:26</enddate>
                        <name>Reloj Inteligente</name>
                        <conditions>Una serie de condiciones que marcan el comportamiento de la oferta a traves del tiempo</conditions>
                        <cost>24.90</cost>
                        <moreinfo>Todal la que quieras</moreinfo>
                        <place>Habana</place>
                        <description>Una descripcion cualquiera sobre el producto</description>
                        <categorias>
                            <category>una categoria</category>
                            <category>otra categoria</category>
                        </categorias>
                        <rebaja1>24.20</rebaja1>
                        <rebaja2>23.50</rebaja2>
                        <rebaja3>22.60</rebaja3>
                        <rebaja4>21.50</rebaja4>
                        <rebaja5>20.20</rebaja5>
                        <rebaja6>19.10</rebaja6>
                        <rebaja7>17.90</rebaja7>
                        <rebaja8>16.70</rebaja8>
                        <rebaja9>15.40</rebaja9>
                        <rebaja10>14.10</rebaja10>
                    </oferta>
                </ofertas>';
        $simple = simplexml_load_string($xml);
        $offers = array();
        foreach ($simple->oferta as $o) {
            $offer = new Offers();
            $offer->setDate(new \DateTime($o->date));
            $offer->setEnddate(new \DateTime($o->enddate));
            $offer->setName($o->name);
            $offer->setCantrequest(0);
            $offer->setConditions($o->conditions);
            $offer->setDescuento(0);
            $offer->setCost($o->cost);
            $offer->setMoreinfo($o->moreinfo);
//        $offer->setPeriod($json['period']);
            $offer->setPlace($o->place);
            $offer->setDescription($o->description);
            if ($o->rebaja1 != null) {
                $offer->setRebaja1($o->rebaja1);
            }
            if ($o->rebaja2 != null) {
                $offer->setRebaja2($o->rebaja2);
            }
            if ($o->rebaja3 != null) {
                $offer->setRebaja3($o->rebaja3);
            }
            if ($o->rebaja4 != null) {
                $offer->setRebaja4($o->rebaja4);
            }
            if ($o->rebaja5 != null) {
                $offer->setRebaja5($o->rebaja5);
            }
            if ($o->rebaja6 != null) {
                $offer->setRebaja6($o->rebaja6);
            }
            if ($o->rebaja7 != null) {
                $offer->setRebaja7($o->rebaja7);
            }
            if ($o->rebaja8 != null) {
                $offer->setRebaja8($o->rebaja8);
            }
            if ($o->rebaja9 != null) {
                $offer->setRebaja9($o->rebaja9);
            }
            if ($o->rebaja10 != null) {
                $offer->setRebaja10($o->rebaja10);
            }
            $provider = $em->getRepository('ApiRestBundle:Providers')->find($json['provider']);
            $offer->setProvider($provider);
            $offer->setEstado("PENDIENTE");
            $em->persist($offer);
            $em->flush();
            foreach ($o->categorias as $cat) {
                $categoria = $em->getRepository('ApiRestBundle:Categorys')->findOneBy(array('name' => $cat));
                if ($categoria != null) {
                    $offer->addCategory($categoria);
                    $categoria->addOffer($offer);
                    $em->persist($categoria);
                    $em->flush();
                    $em->persist($offer);
                    $em->flush();
                }
            }
            $offers[] = $offer;
        }
        return array('offers' => $offers);
    }

}
