<?php

namespace Admin\ApiRestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Impuestos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Admin\ApiRestBundle\Entity\ImpuestosRepository")
 */
class Impuestos
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
     * @ORM\Column(name="tasaimpuesto", type="bigint")
     */
    private $tasaimpuesto;


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
     * @return Impuestos
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
     * @return Impuestos
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
     * Set tasaimpuesto
     *
     * @param integer $tasaimpuesto
     *
     * @return Impuestos
     */
    public function setTasaimpuesto($tasaimpuesto)
    {
        $this->tasaimpuesto = $tasaimpuesto;

        return $this;
    }

    /**
     * Get tasaimpuesto
     *
     * @return integer
     */
    public function getTasaimpuesto()
    {
        return $this->tasaimpuesto;
    }
}
