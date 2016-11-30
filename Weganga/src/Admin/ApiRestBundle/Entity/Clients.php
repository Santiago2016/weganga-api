<?php

namespace Admin\ApiRestBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Clients
 *
 * @ORM\Table(name="tclients")
 * @ORM\Entity
 */
class Clients extends Users
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
     * @ORM\OneToMany(targetEntity="Admin\ApiRestBundle\Entity\Requests", mappedBy="client")
     */
    protected $requests;

    /**
     * @ORM\OneToMany(targetEntity="Admin\ApiRestBundle\Entity\Sales", mappedBy="client")
     */
    protected $sales;

    /**
     * @ORM\ManyToMany(targetEntity="Admin\ApiRestBundle\Entity\Offers", inversedBy="client")
     */
    protected $listofwish;

    /**
     * @ORM\OneToMany(targetEntity="Admin\ApiRestBundle\Entity\Categorys", mappedBy="client")
     */
    protected $interestcategories;

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

    //End of users functions------------------------------

    /**
     * Set dni
     *
     * @param integer $dni
     *
     * @return Clients
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
        $this->requests = new ArrayCollection();
        $this->sales = new ArrayCollection();
        $this->listofwish = new ArrayCollection();
        $this->interestcategories = new ArrayCollection();
    }

    /**
     * Add request
     *
     * @param \Admin\ApiRestBundle\Entity\Requests $request
     *
     * @return Clients
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
     * Add sale
     *
     * @param \Admin\ApiRestBundle\Entity\Sales $sale
     *
     * @return Clients
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

    /**
     * Add listofwish
     *
     * @param \Admin\ApiRestBundle\Entity\Offers $listofwish
     *
     * @return Clients
     */
    public function addListofwish(\Admin\ApiRestBundle\Entity\Offers $listofwish)
    {
        $this->listofwish[] = $listofwish;

        return $this;
    }

    /**
     * Remove listofwish
     *
     * @param \Admin\ApiRestBundle\Entity\Offers $listofwish
     */
    public function removeListofwish(\Admin\ApiRestBundle\Entity\Offers $listofwish)
    {
        $this->listofwish->removeElement($listofwish);
    }

    /**
     * Get listofwish
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getListofwish()
    {
        return $this->listofwish;
    }

    /**
     * Add interestcategory
     *
     * @param \Admin\ApiRestBundle\Entity\Categorys $interestcategory
     *
     * @return Clients
     */
    public function addInterestcategory(\Admin\ApiRestBundle\Entity\Categorys $interestcategory)
    {
        $this->interestcategories[] = $interestcategory;

        return $this;
    }

    /**
     * Remove interestcategory
     *
     * @param \Admin\ApiRestBundle\Entity\Categorys $interestcategory
     */
    public function removeInterestcategory(\Admin\ApiRestBundle\Entity\Categorys $interestcategory)
    {
        $this->interestcategories->removeElement($interestcategory);
    }

    /**
     * Get interestcategories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getInterestcategories()
    {
        return $this->interestcategories;
    }
}
