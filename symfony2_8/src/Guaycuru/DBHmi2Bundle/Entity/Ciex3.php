<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ciex3
 *
 * @ORM\Table(name="ciex_3", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_3dig", columns={"cod_3dig"})}, indexes={@ORM\Index(name="idx_descripcion", columns={"descripcion"})})
 * @ORM\Entity
 */
class Ciex3
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
     * @var integer
     *
     * @ORM\Column(name="id_ciex_3", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiex3;



    /**
     * Set cod3dig
     *
     * @param string $cod3dig
     * @return Ciex3
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Ciex3
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
     * @return Ciex3
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
     * Get idCiex3
     *
     * @return integer 
     */
    public function getIdCiex3()
    {
        return $this->idCiex3;
    }
}
