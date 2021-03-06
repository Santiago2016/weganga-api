<?php

namespace Admin\ApiRestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Requests
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\ApiRestBundle\Entity\RequestsRepository")
 */
class Requests
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="bigint")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Offers", inversedBy="resquests")
     * @ORM\JoinColumn(name="offer_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $offer;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Clients", inversedBy="requests")
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
     * Set date
     *
     * @param \DateTime $date
     * @return Requests
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
     * Set quantity
     *
     * @param integer $quantity
     * @return Requests
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer 
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set offer
     *
     * @param \Admin\ApiRestBundle\Entity\Offers $offer
     *
     * @return Requests
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
     * @return Requests
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
