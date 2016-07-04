<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use STG\DEIM\Themes\Bundles\AplicativoBundle\Annotation\Filter;

/**
 * Camas
 *
 * @ORM\Table(name="camas", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_nombre_id_habitacion", columns={"nombre", "id_habitacion"}), @ORM\UniqueConstraint(name="idx_unique_id_internacion", columns={"id_internacion"})}, indexes={@ORM\Index(name="fk_id_habitacion", columns={"id_habitacion"}), @ORM\Index(name="fk_camas_id_efector", columns={"id_efector"}), @ORM\Index(name="idx_fk_camas_id_clasificacion_cama", columns={"id_clasificacion_cama"})})
 * @ORM\Entity
 */
class Camas
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     * 
     * @Filter(type="text", label="Nombre de cama")
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     * 
     * * @Filter(type="text", label="Estado")
     * 
     */
    private $estado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rotativa", type="boolean", nullable=false)
     */
    private $rotativa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="baja", type="boolean", nullable=false)
     */
    private $baja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_cama", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCama;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Efectores
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     *  
     */
    private $idEfector;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\ClasificacionesCamas
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\ClasificacionesCamas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_clasificacion_cama", referencedColumnName="id_clasificacion_cama")
     * })
     * 
     * 
     */
    private $idClasificacionCama;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Internaciones
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Internaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_internacion", referencedColumnName="id_internacion")
     * })
     */
    private $idInternacion;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Habitaciones
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Habitaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_habitacion", referencedColumnName="id_habitacion")
     * })
     */
    private $idHabitacion;



    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Camas
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
     * Set estado
     *
     * @param string $estado
     * @return Camas
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set rotativa
     *
     * @param boolean $rotativa
     * @return Camas
     */
    public function setRotativa($rotativa)
    {
        $this->rotativa = $rotativa;

        return $this;
    }

    /**
     * Get rotativa
     *
     * @return boolean 
     */
    public function getRotativa()
    {
        return $this->rotativa;
    }

    /**
     * Set baja
     *
     * @param boolean $baja
     * @return Camas
     */
    public function setBaja($baja)
    {
        $this->baja = $baja;

        return $this;
    }

    /**
     * Get baja
     *
     * @return boolean 
     */
    public function getBaja()
    {
        return $this->baja;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Camas
     */
    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;

        return $this;
    }

    /**
     * Get fechaModificacion
     *
     * @return \DateTime 
     */
    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    /**
     * Get idCama
     *
     * @return integer 
     */
    public function getIdCama()
    {
        return $this->idCama;
    }

    /**
     * Set idEfector
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Efectores $idEfector
     * @return Camas
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

    /**
     * Set idClasificacionCama
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\ClasificacionesCamas $idClasificacionCama
     * @return Camas
     */
    public function setIdClasificacionCama(\Guaycuru\DBHmi2Bundle\Entity\ClasificacionesCamas $idClasificacionCama = null)
    {
        $this->idClasificacionCama = $idClasificacionCama;

        return $this;
    }

    /**
     * Get idClasificacionCama
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\ClasificacionesCamas 
     */
    public function getIdClasificacionCama()
    {
        return $this->idClasificacionCama;
    }

    /**
     * Set idInternacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Internaciones $idInternacion
     * @return Camas
     */
    public function setIdInternacion(\Guaycuru\DBHmi2Bundle\Entity\Internaciones $idInternacion = null)
    {
        $this->idInternacion = $idInternacion;

        return $this;
    }

    /**
     * Get idInternacion
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Internaciones 
     */
    public function getIdInternacion()
    {
        return $this->idInternacion;
    }

    /**
     * Set idHabitacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Habitaciones $idHabitacion
     * @return Camas
     */
    public function setIdHabitacion(\Guaycuru\DBHmi2Bundle\Entity\Habitaciones $idHabitacion = null)
    {
        $this->idHabitacion = $idHabitacion;

        return $this;
    }

    /**
     * Get idHabitacion
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Habitaciones 
     */
    public function getIdHabitacion()
    {
        return $this->idHabitacion;
    }
}
