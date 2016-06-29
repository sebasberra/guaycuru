<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InternacionesOperaciones
 *
 * @ORM\Table(name="internaciones_operaciones", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_internacion_nro_orden", columns={"id_internacion", "nro_orden"}), @ORM\UniqueConstraint(name="idx_unique_id_internacion_id_operacion_fecha_operacion", columns={"id_internacion", "id_operacion", "fecha_operacion"})}, indexes={@ORM\Index(name="fk_id_operacion", columns={"id_operacion"}), @ORM\Index(name="idx_id_internacion", columns={"id_internacion"})})
 * @ORM\Entity
 */
class InternacionesOperaciones
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="nro_orden", type="boolean", nullable=false)
     */
    private $nroOrden;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_operacion", type="date", nullable=true)
     */
    private $fechaOperacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dias_preparatoria", type="boolean", nullable=true)
     */
    private $diasPreparatoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_internacion_operacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idInternacionOperacion;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Operaciones
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Operaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_operacion", referencedColumnName="id_operacion")
     * })
     */
    private $idOperacion;

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
     * Set nroOrden
     *
     * @param boolean $nroOrden
     * @return InternacionesOperaciones
     */
    public function setNroOrden($nroOrden)
    {
        $this->nroOrden = $nroOrden;

        return $this;
    }

    /**
     * Get nroOrden
     *
     * @return boolean 
     */
    public function getNroOrden()
    {
        return $this->nroOrden;
    }

    /**
     * Set fechaOperacion
     *
     * @param \DateTime $fechaOperacion
     * @return InternacionesOperaciones
     */
    public function setFechaOperacion($fechaOperacion)
    {
        $this->fechaOperacion = $fechaOperacion;

        return $this;
    }

    /**
     * Get fechaOperacion
     *
     * @return \DateTime 
     */
    public function getFechaOperacion()
    {
        return $this->fechaOperacion;
    }

    /**
     * Set diasPreparatoria
     *
     * @param boolean $diasPreparatoria
     * @return InternacionesOperaciones
     */
    public function setDiasPreparatoria($diasPreparatoria)
    {
        $this->diasPreparatoria = $diasPreparatoria;

        return $this;
    }

    /**
     * Get diasPreparatoria
     *
     * @return boolean 
     */
    public function getDiasPreparatoria()
    {
        return $this->diasPreparatoria;
    }

    /**
     * Get idInternacionOperacion
     *
     * @return integer 
     */
    public function getIdInternacionOperacion()
    {
        return $this->idInternacionOperacion;
    }

    /**
     * Set idOperacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Operaciones $idOperacion
     * @return InternacionesOperaciones
     */
    public function setIdOperacion(\Guaycuru\DBHmi2Bundle\Entity\Operaciones $idOperacion = null)
    {
        $this->idOperacion = $idOperacion;

        return $this;
    }

    /**
     * Get idOperacion
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Operaciones 
     */
    public function getIdOperacion()
    {
        return $this->idOperacion;
    }

    /**
     * Set idInternacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Internaciones $idInternacion
     * @return InternacionesOperaciones
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
}
