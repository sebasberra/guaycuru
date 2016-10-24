<?php

namespace Pruebas\DBHmi2GuaycuruCamasBundle\Entity;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Camas
 *
 * @ORM\Table(name="camas", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_nombre_id_habitacion", columns={"nombre", "id_habitacion"})}, indexes={@ORM\Index(name="idx_fk_camas_id_habitacion", columns={"id_habitacion"}), @ORM\Index(name="idx_fk_camas_id_efector", columns={"id_efector"}), @ORM\Index(name="idx_fk_camas_id_clasificacion_cama", columns={"id_clasificacion_cama"})})
 * @ORM\Entity(repositoryClass="Pruebas\DBHmi2GuaycuruCamasBundle\Entity\CamasRepository")
 * @UniqueEntity(
 *     fields={"nombre", "idEfector"},
 *     message="El nombre de cama ya existe en el efector."
 * )
 * 
 */
class Camas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_cama", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCama;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_internacion", type="integer", nullable=true)
     */
    private $idInternacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado;

    /**
     * @var boolean
     *
     * @ORM\Column(name="rotativa", type="boolean", nullable=false)
     */
    private $rotativa = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="baja", type="boolean", nullable=false)
     */
    private $baja = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion = 'CURRENT_TIMESTAMP';

    /**
     * @var \ClasificacionesCamas
     *
     * @ORM\ManyToOne(targetEntity="ClasificacionesCamas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_clasificacion_cama", referencedColumnName="id_clasificacion_cama")
     * })
     */
    private $idClasificacionCama;

    /**
     * @var \Efectores
     *
     * @ORM\ManyToOne(targetEntity="Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     */
    private $idEfector;

    /**
     * @var \Habitaciones
     *
     * @ORM\ManyToOne(targetEntity="Habitaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_habitacion", referencedColumnName="id_habitacion")
     * })
     */
    private $idHabitacion;



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
     * Set idInternacion
     *
     * @param integer $idInternacion
     *
     * @return Camas
     */
    public function setIdInternacion($idInternacion)
    {
        $this->idInternacion = $idInternacion;

        return $this;
    }

    /**
     * Get idInternacion
     *
     * @return integer
     */
    public function getIdInternacion()
    {
        return $this->idInternacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
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
     *
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
     *
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
     *
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
     *
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
     * Set idClasificacionCama
     *
     * @param \Pruebas\DBHmi2GuaycuruCamasBundle\Entity\ClasificacionesCamas $idClasificacionCama
     *
     * @return Camas
     */
    public function setIdClasificacionCama(\Pruebas\DBHmi2GuaycuruCamasBundle\Entity\ClasificacionesCamas $idClasificacionCama = null)
    {
        $this->idClasificacionCama = $idClasificacionCama;

        return $this;
    }

    /**
     * Get idClasificacionCama
     *
     * @return \Pruebas\DBHmi2GuaycuruCamasBundle\Entity\ClasificacionesCamas
     */
    public function getIdClasificacionCama()
    {
        return $this->idClasificacionCama;
    }

    /**
     * Set idEfector
     *
     * @param \Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Efectores $idEfector
     *
     * @return Camas
     */
    public function setIdEfector(\Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Efectores $idEfector = null)
    {
        $this->idEfector = $idEfector;

        return $this;
    }

    /**
     * Get idEfector
     *
     * @return \Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Efectores
     */
    public function getIdEfector()
    {
        return $this->idEfector;
    }

    /**
     * Set idHabitacion
     *
     * @param \Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones $idHabitacion
     *
     * @return Camas
     */
    public function setIdHabitacion(\Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones $idHabitacion = null)
    {
        $this->idHabitacion = $idHabitacion;

        return $this;
    }

    /**
     * Get idHabitacion
     *
     * @return \Pruebas\DBHmi2GuaycuruCamasBundle\Entity\Habitaciones
     */
    public function getIdHabitacion()
    {
        return $this->idHabitacion;
    }
}
