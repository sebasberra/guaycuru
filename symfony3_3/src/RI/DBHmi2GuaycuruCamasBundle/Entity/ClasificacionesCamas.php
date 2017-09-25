<?php
/**
 * Proyecto Final Ingeniería Informática 2017 - UNL - Santa Fe - Argentina
 * 
 * Web Services Plataforma Web para centralización de camas críticas de internación en hospitales de la Provincia de Santa Fe
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 * 
 * @version 0.1.0
 */
namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * **Tabla: ClasificacionesCamas**
 * 
 * @api *Librería de acceso a la base de datos centralizada del sistema de camas críticas de internación*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *  
 * @link http://www.doctrine-project.org
 * Doctrine Project
 * 
 * @link https://symfony.com/doc/current/doctrine.html
 * Symfony - Databases and the Doctrine ORM
 *
 * @ORM\Table(name="clasificaciones_camas")
 * @ORM\Entity
 */
class ClasificacionesCamas
{
    /**
     * @var integer Clave primaria
     *
     * @ORM\Column(name="id_clasificacion_cama", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idClasificacionCama;

    /**
     * @var string Descripción de la clasificación
     *
     * @ORM\Column(name="clasificacion_cama", type="string", length=50, nullable=false)
     */
    private $clasificacionCama;

    /**
     * @var string Abreviatura de la descripción
     *
     * @ORM\Column(name="abreviatura", type="string", length=5, nullable=false)
     */
    private $abreviatura;

    /**
     * @var string Información extra
     *
     * @ORM\Column(name="definicion", type="text", length=65535, nullable=true)
     */
    private $definicion;

    /**
     * @var integer 0 = cuidado moderado; 1 = cuidado intermedio ; 2 = cuidado crítico
     *
     * @ORM\Column(name="tipo_cuidado_progresivo", type="integer", nullable=false)
     */
    private $tipoCuidadoProgresivo;

    /**
     * @var integer 0 = NO crítica; 1 = crítica
     * 
     * @ORM\Column(name="critica", type="integer", nullable=false)
     */
    private $critica;

    /**
     * @var string ADU= adulto (>14 a); PED= pediátrica (>28 d y <14 a); NEO= neonatológica (<28 d)
     *
     * @ORM\Column(name="categoria_edad", type="string", length=5, nullable=false)
     */
    private $categoriaEdad;

    /**
     * @var integer 0 = sin oxigeno ; 1 = con oxigeno
     *
     * @ORM\Column(name="oxigeno", type="integer", nullable=false)
     */
    private $oxigeno;

    /**
     * @var integer 0 = sin respirador; 1 = con respirador
     *
     * @ORM\Column(name="respirador", type="integer", nullable=false)
     */
    private $respirador;

    /**
     * @var integer 0 = sin aislamiento; 1 = con aislamiento (casos donde el paciente debe estar aislado de los otros por el tipo de efermedad)
     *
     * @ORM\Column(name="aislamiento", type="integer", nullable=false)
     */
    private $aislamiento;

    /**
     * @var \DateTime Fecha de última modificación del registro
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
     * @param integer $tipoCuidadoProgresivo
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
     * @param integer $oxigeno
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
    
    /**
     * Implementación __toString
     *
     * @return string Descripción de la clasificación
     */
    public function __toString()
    {
      return $this->clasificacionCama;
      
    }
}
