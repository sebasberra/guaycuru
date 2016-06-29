<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CiexTitulos
 *
 * @ORM\Table(name="ciex_titulos", indexes={@ORM\Index(name="idx_cod_3dig_desde", columns={"cod_3dig_desde"}), @ORM\Index(name="idx_cod_3dig_hasta", columns={"cod_3dig_hasta"}), @ORM\Index(name="id_ciex_3_desde", columns={"id_ciex_3_desde"}), @ORM\Index(name="id_ciex_3_hasta", columns={"id_ciex_3_hasta"})})
 * @ORM\Entity
 */
class CiexTitulos
{
    /**
     * @var string
     *
     * @ORM\Column(name="capitulo", type="string", length=2, nullable=false)
     */
    private $capitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="grupo", type="string", length=2, nullable=false)
     */
    private $grupo;

    /**
     * @var string
     *
     * @ORM\Column(name="subgrupo", type="string", length=2, nullable=false)
     */
    private $subgrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_3dig_desde", type="string", length=3, nullable=false)
     */
    private $cod3digDesde;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_3dig_hasta", type="string", length=3, nullable=false)
     */
    private $cod3digHasta;

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
     * @ORM\Column(name="id_ciex_titulo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiexTitulo;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex3
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex3")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_3_hasta", referencedColumnName="id_ciex_3")
     * })
     */
    private $idCiex3Hasta;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex3
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex3")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_3_desde", referencedColumnName="id_ciex_3")
     * })
     */
    private $idCiex3Desde;



    /**
     * Set capitulo
     *
     * @param string $capitulo
     * @return CiexTitulos
     */
    public function setCapitulo($capitulo)
    {
        $this->capitulo = $capitulo;

        return $this;
    }

    /**
     * Get capitulo
     *
     * @return string 
     */
    public function getCapitulo()
    {
        return $this->capitulo;
    }

    /**
     * Set grupo
     *
     * @param string $grupo
     * @return CiexTitulos
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return string 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set subgrupo
     *
     * @param string $subgrupo
     * @return CiexTitulos
     */
    public function setSubgrupo($subgrupo)
    {
        $this->subgrupo = $subgrupo;

        return $this;
    }

    /**
     * Get subgrupo
     *
     * @return string 
     */
    public function getSubgrupo()
    {
        return $this->subgrupo;
    }

    /**
     * Set cod3digDesde
     *
     * @param string $cod3digDesde
     * @return CiexTitulos
     */
    public function setCod3digDesde($cod3digDesde)
    {
        $this->cod3digDesde = $cod3digDesde;

        return $this;
    }

    /**
     * Get cod3digDesde
     *
     * @return string 
     */
    public function getCod3digDesde()
    {
        return $this->cod3digDesde;
    }

    /**
     * Set cod3digHasta
     *
     * @param string $cod3digHasta
     * @return CiexTitulos
     */
    public function setCod3digHasta($cod3digHasta)
    {
        $this->cod3digHasta = $cod3digHasta;

        return $this;
    }

    /**
     * Get cod3digHasta
     *
     * @return string 
     */
    public function getCod3digHasta()
    {
        return $this->cod3digHasta;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CiexTitulos
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
     * @return CiexTitulos
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
     * Get idCiexTitulo
     *
     * @return integer 
     */
    public function getIdCiexTitulo()
    {
        return $this->idCiexTitulo;
    }

    /**
     * Set idCiex3Hasta
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3Hasta
     * @return CiexTitulos
     */
    public function setIdCiex3Hasta(\Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3Hasta = null)
    {
        $this->idCiex3Hasta = $idCiex3Hasta;

        return $this;
    }

    /**
     * Get idCiex3Hasta
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Ciex3 
     */
    public function getIdCiex3Hasta()
    {
        return $this->idCiex3Hasta;
    }

    /**
     * Set idCiex3Desde
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3Desde
     * @return CiexTitulos
     */
    public function setIdCiex3Desde(\Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3Desde = null)
    {
        $this->idCiex3Desde = $idCiex3Desde;

        return $this;
    }

    /**
     * Get idCiex3Desde
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Ciex3 
     */
    public function getIdCiex3Desde()
    {
        return $this->idCiex3Desde;
    }
}
