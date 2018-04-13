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

use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * **Tabla: ConfiguracionesSistemas**
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
 *
 * @ORM\Table(name="configuraciones_sistemas", indexes={@ORM\Index(name="idx_fk_configuraciones_sistemas_id_efector", columns={"id_efector"})})
 * @ORM\Entity
 */
class ConfiguracionesSistemas
{
    /**
     * @var integer Clave primaria
     *
     * @ORM\Column(name="id_configuracion_sistema", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConfiguracionSistema;

    /**
     * @var boolean Define si está activo el efector en el sistema
     *
     * @ORM\Column(name="activa", type="boolean", nullable=false)
     */
    private $activa;

    /**
     * @var integer 0=ABM; 1=WS
     *
     * @Assert\Choice({0, 1},
     *      message = "El valor de tipo_registros: {{ value }} no es válido. Valores posibles 0=ABM, 1=WS"
     * )
     * 
     * @ORM\Column(name="tipo_registros", type="integer", nullable=false)
     */
    private $tipoRegistros;
    
    /**
     * @var \DateTime Fecha de última sincronización por web services
     *
     * @ORM\Column(name="fecha_hora_sincro", type="datetime", nullable=true)
     */
    private $fechaHoraSincro;
    
    /**
     * @var string Descripción u observación del efector
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var \Efectores Efector asociado
     *
     * @ORM\ManyToOne(targetEntity="Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     */
    private $idEfector;



    /**
     * Get idConfiguracionSistema
     *
     * @return integer
     */
    public function getIdConfiguracionSistema()
    {
        return $this->idConfiguracionSistema;
    }

    /**
     * Set activa
     *
     * @param boolean $activa
     *
     * @return ConfiguracionesSistemas
     */
    public function setActiva($activa)
    {
        $this->activa = $activa;

        return $this;
    }

    /**
     * Get activa
     *
     * @return boolean
     */
    public function getActiva()
    {
        return $this->activa;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return ConfiguracionesSistemas
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set idEfector
     *
     * @param \RI\DBHmi2GuaycuruBundle\Entity\Efectores $idEfector
     *
     * @return ConfiguracionesSistemas
     */
    public function setIdEfector(\RI\DBHmi2GuaycuruBundle\Entity\Efectores $idEfector = null)
    {
        $this->idEfector = $idEfector;

        return $this;
    }

    /**
     * Get idEfector
     *
     * @return \RI\DBHmi2GuaycuruBundle\Entity\Efectores
     */
    public function getIdEfector()
    {
        return $this->idEfector;
    }
    
    /**
     * Set tipoRegistros
     *
     * @param integer $tipoRegistros
     *
     * @return ConfiguracionesSistemas
     */
    public function setTipoRegistros($tipoRegistros)
    {
        $this->tipoRegistros = $tipoRegistros;

        return $this;
    }

    /**
     * Get tipoRegistros
     *
     * @return integer
     */
    public function getTipoRegistros()
    {
        return $this->tipoRegistros;
    }
    
    /**
     * Set fechaHoraSincro
     *
     * @param \DateTime $fechaHoraSincro
     *
     * @return ConfiguracionesSistemas
     */
    public function setFechaHoraSincro($fechaHoraSincro)
    {
        $this->fechaHoraSincro = $fechaHoraSincro;

        return $this;
    }

    /**
     * Get fechaHoraSincro
     *
     * @return \DateTime
     */
    public function getFechaHoraSincro()
    {
        return $this->fechaHoraSincro;
    }
}
