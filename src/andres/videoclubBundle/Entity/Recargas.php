<?php

namespace andres\videoclubBundle\Entity;
use andres\videoclubBundle\Entity\Users;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

/**
 * Recargas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="andres\videoBundle\Entity\RecargasRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Recargas
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
     * @ORM\Column(name="descripcion", type="string", length=150)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRecarga", type="datetime")
     */
    private $fechaRecarga;

    /**
     * @var float
     *
     * @ORM\Column(name="monto", type="decimal")
     */
    private $monto;

    /**
     * @var integer
     *
     * @ORM\Column(name="numTarjeta", type="integer")
     */
    private $numTarjeta;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreTitular", type="string", length=150)
     */
    private $nombreTitular;

    /**
     * @var integer
     *
     * @ORM\Column(name="mesExpiracion", type="integer")
     */
    private $mesExpiracion;

     /**
     * @ORM\ManyToOne(targetEntity="Users", inversedBy="Recargas")
     * @ORM\JoinColumn(name="users_id", referencedColumnName="id")
     * 
     */
    private $users;



    /**
     * @var integer
     *
     * @ORM\Column(name="anioExpiracion", type="integer")
     */
    private $anioExpiracion; 

    /**
     * @var integer
     *
     * @ORM\Column(name="codigoSeguridad", type="integer")
     */
    private $codigoSeguridad; 

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
     * Set Users
     *
     * @param \videoclubBundle\Entity\Users $users
     * @return Recargas
     */
    public function setUsers(Users $users)
    {
        $this->users = $users;

        return $this;
    }

    /**
     * Get Users
     *
     * @return \videoBundle\Entity\Users 
     */
    public function getUsers()
    {
        return $this->users;
    }

     /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Recargas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }


    /**
     * Set fechaRecarga
     *
     * @param \DateTime $fechaRecarga
     * @return Recargas
     */
    public function setFechaRecarga($fechaRecarga)
    {
        $this->fechaRecarga = $fechaRecarga;
    
        return $this;
    }

    /**
     * Get fechaRecarga
     *
     * @return \DateTime 
     */
    public function getFechaRecarga()
    {
        return $this->fechaRecarga;
    }

    /**
     * Set monto
     *
     * @param float $monto
     * @return Recargas
     */
    public function setMonto($monto)
    {
        $this->monto = $monto;
    
        return $this;
    }

    /**
     * Get monto
     *
     * @return float 
     */
    public function getMonto()
    {
        return $this->monto;
    }

    /**
     * Set numTarjeta
     *
     * @param integer $numTarjeta
     * @return Recargas
     */
    public function setNumTarjeta($numTarjeta)
    {
        $this->numTarjeta = $numTarjeta;
    
        return $this;
    }

    /**
     * Get numTarjeta
     *
     * @return integer 
     */
    public function getNumTarjeta()
    {
        return $this->numTarjeta;
    }


     /**
     * Set codigoSeguridad
     *
     * @param integer $codigoSeguridad
     * @return Recargas
     */
    public function setCodigoSeguridad($codigoSeguridad)
    {
        $this->codigoSeguridad = $codigoSeguridad;
    
        return $this;
    }

    /**
     * Get codigoSeguridad
     *
     * @return integer 
     */
    public function getCodigoSeguridad()
    {
        return $this->codigoSeguridad;
    }


    /**
     * Set nombreTitular
     *
     * @param string $nombreTitular
     * @return Recargas
     */
    public function setNombreTitular($nombreTitular)
    {
        $this->nombreTitular = $nombreTitular;
    
        return $this;
    }

    /**
     * Get nombreTitular
     *
     * @return string 
     */
    public function getNombreTitular()
    {
        return $this->nombreTitular;
    }

    /**
     * Set mesExpiracion
     *
     * @param integer $mesExpiracion
     * @return Recargas
     */
    public function setMesExpiracion($mesExpiracion)
    {
        $this->mesExpiracion = $mesExpiracion;
    
        return $this;
    }

    /**
     * Get mesExpiracion
     *
     * @return integer 
     */
    public function getMesExpiracion()
    {
        return $this->mesExpiracion;
    }

    /**
     * Set anioExpiracion
     *
     * @param integer $anioExpiracion
     * @return Recargas
     */
    public function setAnioExpiracion($anioExpiracion)
    {
        $this->anioExpiracion = $anioExpiracion;
    
        return $this;
    }

    /**
     * Get anioExpiracion
     *
     * @return integer 
     */
    public function getAnioExpiracion()
    {
        return $this->anioExpiracion;
    }

    /**
     * @ORM\PrePersist
     */
    public function setFechaRecargaValue()
    {
        $this->fechaRecarga = new \DateTime();
    }
}
