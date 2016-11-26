<?php

namespace Admin\ApiRestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorys
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\ApiRestBundle\Entity\CategorysRepository")
 */
class Categorys
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
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\ManyToMany(targetEntity="Admin\ApiRestBundle\Entity\Offers", inversedBy="categorys")
     */
    private $offers;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Providers", inversedBy="categorys")
     * @ORM\JoinColumn(name="provider_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $provider;

    /**
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Clients", inversedBy="interestcategories")
     * @ORM\JoinColumn(name="client_interest_id", referencedColumnName="id", onDelete="CASCADE")
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
     *
     * @return Categorys
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
     * Set description
     *
     * @param string $description
     *
     * @return Categorys
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
     * Constructor
     */
    public function __construct()
    {
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add offer
     *
     * @param \Admin\ApiRestBundle\Entity\Offers $offer
     *
     * @return Categorys
     */
    public function addOffer(\Admin\ApiRestBundle\Entity\Offers $offer)
    {
        $this->offers[] = $offer;

        return $this;
    }

    /**
     * Remove offer
     *
     * @param \Admin\ApiRestBundle\Entity\Offers $offer
     */
    public function removeOffer(\Admin\ApiRestBundle\Entity\Offers $offer)
    {
        $this->offers->removeElement($offer);
    }

    /**
     * Get offers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOffers()
    {
        return $this->offers;
    }

    /**
     * Set provider
     *
     * @param \Admin\ApiRestBundle\Entity\Providers $provider
     *
     * @return Categorys
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
     * Set client
     *
     * @param \Admin\ApiRestBundle\Entity\Clients $client
     *
     * @return Categorys
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

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name;
    }
}
