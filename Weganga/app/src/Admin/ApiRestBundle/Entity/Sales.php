<?php

namespace Admin\ApiRestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sales
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\ApiRestBundle\Entity\SalesRepository")
 */
class Sales
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
     * @var boolean
     *
     * @ORM\Column(name="delivery", type="boolean")
     */
    private $delivery;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="bigint")
     */
    private $quantity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Offers", inversedBy="sales")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Clients", inversedBy="sales")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id", onDelete="CASCADE")
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
     * Set delivery
     *
     * @param string $delivery
     * @return Sales
     */
    public function setDelivery($delivery)
    {
        $this->delivery = $delivery;

        return $this;
    }

    /**
     * Get delivery
     *
     * @return string 
     */
    public function getDelivery()
    {
        return $this->delivery;
    }

    /**
     * Set quantity
     *
     * @param string $quantity
     * @return Sales
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return string 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Sales
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
     * Set offer
     *
     * @param \Admin\ApiRestBundle\Entity\Offers $offer
     *
     * @return Sales
     */
    public function setOffer(\Admin\ApiRestBundle\Entity\Offers $offer = null)
    {
        $this->offer = $offer;

        return $this;
    }

    /**
     * Get offer
     *
     * @return \Admin\ApiRestBundle\Entity\Offers
     */
    public function getOffer()
    {
        return $this->offer;
    }

    /**
     * Set client
     *
     * @param \Admin\ApiRestBundle\Entity\Clients $client
     *
     * @return Sales
     */
    public function setClient(\Admin\ApiRestBundle\Entity\Clients $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Admin\ApiRestBundle\Entity\Clients
     */
    public function getClient()
    {
        return $this->client;
    }
}
