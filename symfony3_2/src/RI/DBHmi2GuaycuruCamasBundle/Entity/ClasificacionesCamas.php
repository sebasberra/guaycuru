<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClasificacionesCamas
 *
 * @ORM\Table(name="clasificaciones_camas")
 * @ORM\Entity
 */
class ClasificacionesCamas
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="id_clasificacion_cama", type="boolean", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClasificacionCama;

    /**
     * @var string
     *
     * @ORM\Column(name="clasificacion_cama", type="string", length=50, nullable=false)
     */
    private $clasificacionCama;

    /**
     * @var string
     *
     * @ORM\Column(name="abreviatura", type="string", length=5, nullable=false)
     */
    private $abreviatura;

    /**
     * @var string
     *
     * @ORM\Column(name="definicion", type="text", length=65535, nullable=true)
     */
    private $definicion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo_cuidado_progresivo", type="boolean", nullable=false)
     */
    private $tipoCuidadoProgresivo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="critica", type="boolean", nullable=false)
     */
    private $critica;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria_edad", type="string", length=5, nullable=false)
     */
    private $categoriaEdad;

    /**
     * @var boolean
     *
     * @ORM\Column(name="oxigeno", type="boolean", nullable=false)
     */
    private $oxigeno;

    /**
     * @var boolean
     *
     * @ORM\Column(name="respirador", type="boolean", nullable=false)
     */
    private $respirador;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aislamiento", type="boolean", nullable=false)
     */
    private $aislamiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_expiracion", type="date", nullable=true)
     */
    private $fechaExpiracion;



    /**
     * Get idClasificacionCama
     *
     * @return boolean
     */
    public function getIdClasificacionCama()
    {
        return $this->idClasificacionCama;
    }

    /**
     * Set clasificacionCama
     *
     * @param string $clasificacionCama
     *
     * @return ClasificacionesCamas
     */
    public function setClasificacionCama($clasificacionCama)
    {
        $this->clasificacionCama = $clasificacionCama;

        return $this;
    }

    /**
     * Get clasificacionCama
     *
     * @return string
     */
    public function getClasificacionCama()
    {
        return $this->clasificacionCama;
    }

    /**
     * Set abreviatura
     *
     * @param string $abreviatura
     *
     * @return ClasificacionesCamas
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;

        return $this;
    }

    /**
     * Get abreviatura
     *
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * Set definicion
     *
     * @param string $definicion
     *
     * @return ClasificacionesCamas
     */
    public function setDefinicion($definicion)
    {
        $this->definicion = $definicion;

        return $this;
    }

    /**
     * Get definicion
     *
     * @return string
     */
    public function getDefinicion()
    {
        return $this->definicion;
    }

    /**
     * Set tipoCuidadoProgresivo
     *
     * @param boolean $tipoCuidadoProgresivo
     *
     * @return ClasificacionesCamas
     */
    public function setTipoCuidadoProgresivo($tipoCuidadoProgresivo)
    {
        $this->tipoCuidadoProgresivo = $tipoCuidadoProgresivo;

        return $this;
    }

    /**
     * Get tipoCuidadoProgresivo
     *
     * @return boolean
     */
    public function getTipoCuidadoProgresivo()
    {
        return $this->tipoCuidadoProgresivo;
    }

    /**
     * Set critica
     *
     * @param boolean $critica
     *
     * @return ClasificacionesCamas
     */
    public function setCritica($critica)
    {
        $this->critica = $critica;

        return $this;
    }

    /**
     * Get critica
     *
     * @return boolean
     */
    public function getCritica()
    {
        return $this->critica;
    }

    /**
     * Set categoriaEdad
     *
     * @param string $categoriaEdad
     *
     * @return ClasificacionesCamas
     */
    public function setCategoriaEdad($categoriaEdad)
    {
        $this->categoriaEdad = $categoriaEdad;

        return $this;
    }

    /**
     * Get categoriaEdad
     *
     * @return string
     */
    public function getCategoriaEdad()
    {
        return $this->categoriaEdad;
    }

    /**
     * Set oxigeno
     *
     * @param boolean $oxigeno
     *
     * @return ClasificacionesCamas
     */
    public function setOxigeno($oxigeno)
    {
        $this->oxigeno = $oxigeno;

        return $this;
    }

    /**
     * Get oxigeno
     *
     * @return boolean
     */
    public function getOxigeno()
    {
        return $this->oxigeno;
    }

    /**
     * Set respirador
     *
     * @param boolean $respirador
     *
     * @return ClasificacionesCamas
     */
    public function setRespirador($respirador)
    {
        $this->respirador = $respirador;

        return $this;
    }

    /**
     * Get respirador
     *
     * @return boolean
     */
    public function getRespirador()
    {
        return $this->respirador;
    }

    /**
     * Set aislamiento
     *
     * @param boolean $aislamiento
     *
     * @return ClasificacionesCamas
     */
    public function setAislamiento($aislamiento)
    {
        $this->aislamiento = $aislamiento;

        return $this;
    }

    /**
     * Get aislamiento
     *
     * @return boolean
     */
    public function getAislamiento()
    {
        return $this->aislamiento;
    }

    /**
     * Set fechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
     *
     * @return ClasificacionesCamas
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;

        return $this;
    }

    /**
     * Get fechaExpiracion
     *
     * @return \DateTime
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }
}
