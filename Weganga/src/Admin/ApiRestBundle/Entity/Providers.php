<?php

namespace Admin\ApiRestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Providers
 *
 * @ORM\Table(name="tproviders")
 * @ORM\Entity(repositoryClass="Admin\ApiRestBundle\Entity\ProvidersRepository")
 */
class Providers extends Users
{
    //Users data------------------------------------------

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $role;

    /**
     * @var string
     */
    protected $nombre;

    /**
     * @var string
     */
    protected $apellidos;

    /**
     * @var string
     */
    protected $direccion;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $telefono;

    /**
     * @var integer
     */
    protected $codigopostal;

    //End of users data-----------------------------------

    /**
     * @var integer
     *
     * @ORM\Column(name="dni", type="bigint")
     */
    protected $dni;

    /**
     * @ORM\OneToMany(targetEntity="Admin\ApiRestBundle\Entity\Offers", mappedBy="provider")
     */
    protected $offers;

    /**
     * @ORM\OneToMany(targetEntity="Admin\ApiRestBundle\Entity\Categorys", mappedBy="provider")
     */
    protected $categorys;

    //Users functions-------------------------------------

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
     * Set username
     *
     * @param string $username
     * @return Users
     */
    public function setUsername($username) {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Users
     */
    public function setRole($role) {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles() {
        // TODO: Implement getRoles() method.
        return array($this->getRole());
    }

    public function equals(Users $user) {
        if ($this->username == $user->getUsername() && $this->password == $user->getPassword()) {
            return true;
        }
        return false;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Users
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Users
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return Users
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return Users
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set codigopostal
     *
     * @param integer $codigopostal
     *
     * @return Users
     */
    public function setCodigopostal($codigopostal)
    {
        $this->codigopostal = $codigopostal;

        return $this;
    }

    /**
     * Get codigopostal
     *
     * @return integer
     */
    public function getCodigopostal()
    {
        return $this->codigopostal;
    }

    //End of users function-------------------------------

    /**
     * Set dni
     *
     * @param integer $dni
     * @return Providers
     */
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get dni
     *
     * @return integer 
     */
    public function getDni()
    {
        return $this->dni;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->offers = new \Doctrine\Common\Collections\ArrayCollection();
        $this->categorys = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add offer
     *
     * @param \Admin\ApiRestBundle\Entity\Offers $offer
     *
     * @return Providers
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
     * Add category
     *
     * @param \Admin\ApiRestBundle\Entity\Categorys $category
     *
     * @return Providers
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
}
