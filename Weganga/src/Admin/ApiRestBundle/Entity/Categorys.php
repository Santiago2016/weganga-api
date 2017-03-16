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
     * @ORM\ManyToOne(targetEntity="Admin\ApiRestBundle\Entity\Users", inversedBy="categorys")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $user;
    
    /**
     * @var string
     *
     * @ORM\Column(name="borrable", type="string", length=3)
     */
    private $borrable;//SI NO

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    function getBorrable() {
        return $this->borrable;
    }

    function setBorrable($borrable) {
        $this->borrable = $borrable;
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
     * @param \Admin\ApiRestBundle\Entity\Users $provider
     *
     * @return Categorys
     */
    public function setUser(\Admin\ApiRestBundle\Entity\Users $provider = null)
    {
        $this->user = $provider;

        return $this;
    }

    /**
     * Get provider
     *
     * @return \Admin\ApiRestBundle\Entity\Users
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->name;
    }
}
