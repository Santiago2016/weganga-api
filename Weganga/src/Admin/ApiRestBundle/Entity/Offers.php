<?php

namespace Admin\ApiRestBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Offers
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\ApiRestBundle\Entity\OffersRepository")
 */
class Offers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="descuento", type="integer")
     */
    private $descuento;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="enddate", type="datetime")
     */
    private $enddate;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantrequest", type="bigint")
     */
    private $cantrequest;

    /**
     * @var string
     *
     * @ORM\Column(name="period", type="string", length=255)
     */
    private $period;

    /**
     * @var string
     *
     * @ORM\Column(name="conditions", type="string", length=255)
     */
    private $conditions;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float")
     */
    private $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="moreinfo", type="string", length=255)
     */
    private $moreinfo;

    /**
     * @var string
     *
     * @ORM\ManyToMany(targetEntity="Admin\ApiRestBundle\Entity\Categorys", mappedBy="offers")
     */
    private $categorys;

    /**
     * @ORM\OneToMany(targetEntity="Admin\ApiRestBundle\Entity\Requests", mappedBy="offer")
     */
    private $requests;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Providers", inversedBy="offers")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $provider;

    /**
     * @ORM\OneToMany(targetEntity="Admin\ApiRestBundle\Entity\Sales", mappedBy="offer")
     */
    private $sales;

    /**
     * @ORM\ManyToMany(targetEntity="Admin\ApiRestBundle\Entity\Clients", mappedBy="listofwish")
     */
    private $client;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Offers
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set place
     *
     * @param string $place
     * @return Offers
     */
    public function setPlace($place)
    {
        $this->place = $place;

        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set descuento
     *
     * @param string $descuento
     * @return Offers
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;

        return $this;
    }

    /**
     * Get descuento
     *
     * @return string 
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Offers
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set cantrequest
     *
     * @param integer $cantrequest
     * @return Offers
     */
    public function setCantrequest($cantrequest)
    {
        $this->cantrequest = $cantrequest;

        return $this;
    }

    /**
     * Get cantrequest
     *
     * @return integer 
     */
    public function getCantrequest()
    {
        return $this->cantrequest;
    }

    /**
     * Set period
     *
     * @param string $period
     * @return Offers
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return string 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set conditions
     *
     * @param string $conditions
     * @return Offers
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return string 
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set cost
     *
     * @param float $cost
     * @return Offers
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set moreinfo
     *
     * @param string $moreinfo
     * @return Offers
     */
    public function setMoreinfo($moreinfo)
    {
        $this->moreinfo = $moreinfo;

        return $this;
    }

    /**
     * Get moreinfo
     *
     * @return string 
     */
    public function getMoreinfo()
    {
        return $this->moreinfo;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Offers
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set enddate
     *
     * @param \DateTime $enddate
     *
     * @return Offers
     */
    public function setEnddate($enddate)
    {
        $this->enddate = $enddate;

        return $this;
    }

    /**
     * Get enddate
     *
     * @return \DateTime
     */
    public function getEnddate()
    {
        return $this->enddate;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorys = new ArrayCollection();
        $this->requests = new ArrayCollection();
        $this->sales = new ArrayCollection();
        $this->client = new ArrayCollection();
    }

    /**
     * Add category
     *
     * @param \Admin\ApiRestBundle\Entity\Categorys $category
     *
     * @return Offers
     */
    public function addCategory(\Admin\ApiRestBundle\Entity\Categorys $category)
    {
        $this->categorys[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \Admin\ApiRestBundle\Entity\Categorys $category
     */
    public function removeCategory(\Admin\ApiRestBundle\Entity\Categorys $category)
    {
        $this->categorys->removeElement($category);
    }

    /**
     * Get categorys
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorys()
    {
        return $this->categorys;
    }

    /**
     * Add request
     *
     * @param \Admin\ApiRestBundle\Entity\Requests $request
     *
     * @return Offers
     */
    public function addRequest(\Admin\ApiRestBundle\Entity\Requests $request)
    {
        $this->requests[] = $request;

        return $this;
    }

    /**
     * Remove request
     *
     * @param \Admin\ApiRestBundle\Entity\Requests $request
     */
    public function removeRequest(\Admin\ApiRestBundle\Entity\Requests $request)
    {
        $this->requests->removeElement($request);
    }

    /**
     * Get requests
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * Set provider
     *
     * @param \Admin\ApiRestBundle\Entity\Providers $provider
     *
     * @return Offers
     */
    public function setProvider(\Admin\ApiRestBundle\Entity\Providers $provider = null)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \Admin\ApiRestBundle\Entity\Providers
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Add sale
     *
     * @param \Admin\ApiRestBundle\Entity\Sales $sale
     *
     * @return Offers
     */
    public function addSale(\Admin\ApiRestBundle\Entity\Sales $sale)
    {
        $this->sales[] = $sale;

        return $this;
    }

    /**
     * Remove sale
     *
     * @param \Admin\ApiRestBundle\Entity\Sales $sale
     */
    public function removeSale(\Admin\ApiRestBundle\Entity\Sales $sale)
    {
        $this->sales->removeElement($sale);
    }

    /**
     * Get sales
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSales()
    {
        return $this->sales;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name;
    }

    /**
     * Add client
     *
     * @param \Admin\ApiRestBundle\Entity\Clients $client
     *
     * @return Offers
     */
    public function addClient(\Admin\ApiRestBundle\Entity\Clients $client)
    {
        $this->client[] = $client;

        return $this;
    }

    /**
     * Remove client
     *
     * @param \Admin\ApiRestBundle\Entity\Clients $client
     */
    public function removeClient(\Admin\ApiRestBundle\Entity\Clients $client)
    {
        $this->client->removeElement($client);
    }

    /**
     * Get client
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getClient()
    {
        return $this->client;
    }
}
