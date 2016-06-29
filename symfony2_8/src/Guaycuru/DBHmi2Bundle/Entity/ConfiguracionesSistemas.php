<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ConfiguracionesSistemas
 *
 * @ORM\Table(name="configuraciones_sistemas", indexes={@ORM\Index(name="fk_configuraciones_sistemas_id_efector", columns={"id_efector"})})
 * @ORM\Entity
 */
class ConfiguracionesSistemas
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="activa", type="boolean", nullable=false)
     */
    private $activa;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_configuracion_sistema", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idConfiguracionSistema;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Efectores
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     */
    private $idEfector;



    /**
     * Set activa
     *
     * @param boolean $activa
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
     * Get idConfiguracionSistema
     *
     * @return integer 
     */
    public function getIdConfiguracionSistema()
    {
        return $this->idConfiguracionSistema;
    }

    /**
     * Set idEfector
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Efectores $idEfector
     * @return ConfiguracionesSistemas
     */
    public function setIdEfector(\Guaycuru\DBHmi2Bundle\Entity\Efectores $idEfector = null)
    {
        $this->idEfector = $idEfector;

        return $this;
    }

    /**
     * Get idEfector
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Efectores 
     */
    public function getIdEfector()
    {
        return $this->idEfector;
    }
}
