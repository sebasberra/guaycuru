<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciex4
 *
 * @ORM\Table(name="ciex_4", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_3dig_cod_4dig", columns={"cod_3dig", "cod_4dig"})}, indexes={@ORM\Index(name="idx_descripcion", columns={"descripcion"}), @ORM\Index(name="id_ciex_3", columns={"id_ciex_3"})})
 * @ORM\Entity
 */
class Ciex4
{
    /**
     * @var string
     *
     * @ORM\Column(name="cod_3dig", type="string", length=3, nullable=false)
     */
    private $cod3dig;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_4dig", type="string", length=1, nullable=false)
     */
    private $cod4dig;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_red", type="string", length=50, nullable=false)
     */
    private $descRed;

    /**
     * @var string
     *
     * @ORM\Column(name="informa_c2", type="string", nullable=false)
     */
    private $informaC2;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ciex_4", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiex4;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex3
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex3")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_3", referencedColumnName="id_ciex_3")
     * })
     */
    private $idCiex3;



    /**
     * Set cod3dig
     *
     * @param string $cod3dig
     * @return Ciex4
     */
    public function setCod3dig($cod3dig)
    {
        $this->cod3dig = $cod3dig;

        return $this;
    }

    /**
     * Get cod3dig
     *
     * @return string 
     */
    public function getCod3dig()
    {
        return $this->cod3dig;
    }

    /**
     * Set cod4dig
     *
     * @param string $cod4dig
     * @return Ciex4
     */
    public function setCod4dig($cod4dig)
    {
        $this->cod4dig = $cod4dig;

        return $this;
    }

    /**
     * Get cod4dig
     *
     * @return string 
     */
    public function getCod4dig()
    {
        return $this->cod4dig;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Ciex4
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
     * Set descRed
     *
     * @param string $descRed
     * @return Ciex4
     */
    public function setDescRed($descRed)
    {
        $this->descRed = $descRed;

        return $this;
    }

    /**
     * Get descRed
     *
     * @return string 
     */
    public function getDescRed()
    {
        return $this->descRed;
    }

    /**
     * Set informaC2
     *
     * @param string $informaC2
     * @return Ciex4
     */
    public function setInformaC2($informaC2)
    {
        $this->informaC2 = $informaC2;

        return $this;
    }

    /**
     * Get informaC2
     *
     * @return string 
     */
    public function getInformaC2()
    {
        return $this->informaC2;
    }

    /**
     * Get idCiex4
     *
     * @return integer 
     */
    public function getIdCiex4()
    {
        return $this->idCiex4;
    }

    /**
     * Set idCiex3
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3
     * @return Ciex4
     */
    public function setIdCiex3(\Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3 = null)
    {
        $this->idCiex3 = $idCiex3;

        return $this;
    }

    /**
     * Get idCiex3
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Ciex3 
     */
    public function getIdCiex3()
    {
        return $this->idCiex3;
    }
}
