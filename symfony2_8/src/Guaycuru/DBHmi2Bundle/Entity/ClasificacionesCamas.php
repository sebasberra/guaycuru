<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

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
     * @var integer
     *
     * @ORM\Column(name="id_clasificacion_cama", type="integer", nullable=false)
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
     * @var integer
     *
     * @ORM\Column(name="tipo_cuidado_progresivo", type="integer", nullable=false)
     */
    private $tipoCuidadoProgresivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="critica", type="integer", nullable=false)
     */
    private $critica;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria_edad", type="string", length=5, nullable=false)
     */
    private $categoriaEdad;

    /**
     * @var integer
     *
     * @ORM\Column(name="oxigeno", type="integer", nullable=false)
     */
    private $oxigeno;

    /**
     * @var integer
     *
     * @ORM\Column(name="respirador", type="integer", nullable=false)
     */
    private $respirador;

    /**
     * @var integer
     *
     * @ORM\Column(name="aislamiento", type="integer", nullable=false)
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
     * @return integer 
     */
    public function getIdClasificacionCama()
    {
        return $this->idClasificacionCama;
    }

    /**
     * Set clasificacionCama
     *
     * @param string $clasificacionCama
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
     * @param integer $tipoCuidadoProgresivo
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
     * @return integer 
     */
    public function getTipoCuidadoProgresivo()
    {
        return $this->tipoCuidadoProgresivo;
    }

    /**
     * Set critica
     *
     * @param integer $critica
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
     * @return integer 
     */
    public function getCritica()
    {
        return $this->critica;
    }

    /**
     * Set categoriaEdad
     *
     * @param string $categoriaEdad
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
     * @param integer $oxigeno
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
     * @return integer 
     */
    public function getOxigeno()
    {
        return $this->oxigeno;
    }

    /**
     * Set respirador
     *
     * @param integer $respirador
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
     * @return integer 
     */
    public function getRespirador()
    {
        return $this->respirador;
    }

    /**
     * Set aislamiento
     *
     * @param integer $aislamiento
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
     * @return integer 
     */
    public function getAislamiento()
    {
        return $this->aislamiento;
    }

    /**
     * Set fechaExpiracion
     *
     * @param \DateTime $fechaExpiracion
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
