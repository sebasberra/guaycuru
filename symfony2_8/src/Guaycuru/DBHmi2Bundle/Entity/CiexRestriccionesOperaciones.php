<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CiexRestriccionesOperaciones
 *
 * @ORM\Table(name="ciex_restricciones_operaciones", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_ciex_restriccion_id_operacion_desde", columns={"id_ciex_restriccion", "id_operacion_desde"}), @ORM\UniqueConstraint(name="idx_unique_id_ciex_restriccion_cod_operacion_desde", columns={"id_ciex_restriccion", "cod_operacion_desde"}), @ORM\UniqueConstraint(name="idx_unique_id_ciex_restriccion_id_operacion_hasta", columns={"id_ciex_restriccion", "id_operacion_hasta"}), @ORM\UniqueConstraint(name="idx_unique_id_ciex_restriccion_cod_operacion_hasta", columns={"cod_operacion_hasta", "id_ciex_restriccion"})}, indexes={@ORM\Index(name="idx_fk_id_ciex_restriccion", columns={"id_ciex_restriccion"}), @ORM\Index(name="idx_fk_id_operacion_desde", columns={"id_operacion_desde"}), @ORM\Index(name="idx_fk_id_operacion_hasta", columns={"id_operacion_hasta"}), @ORM\Index(name="idx_cod_operacion_desde", columns={"cod_operacion_desde"}), @ORM\Index(name="idx_cod_operacion_hasta", columns={"cod_operacion_hasta"})})
 * @ORM\Entity
 */
class CiexRestriccionesOperaciones
{
    /**
     * @var string
     *
     * @ORM\Column(name="cod_operacion_desde", type="string", length=4, nullable=false)
     */
    private $codOperacionDesde;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_operacion_hasta", type="string", length=4, nullable=false)
     */
    private $codOperacionHasta;

    /**
     * @var boolean
     *
     * @ORM\Column(name="restriccion_operacion", type="boolean", nullable=false)
     */
    private $restriccionOperacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ciex_restriccion_operaciones", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiexRestriccionOperaciones;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Operaciones
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Operaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_operacion_hasta", referencedColumnName="id_operacion")
     * })
     */
    private $idOperacionHasta;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Operaciones
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Operaciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_operacion_desde", referencedColumnName="id_operacion")
     * })
     */
    private $idOperacionDesde;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\CiexRestricciones
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\CiexRestricciones")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_restriccion", referencedColumnName="id_ciex_restriccion")
     * })
     */
    private $idCiexRestriccion;



    /**
     * Set codOperacionDesde
     *
     * @param string $codOperacionDesde
     * @return CiexRestriccionesOperaciones
     */
    public function setCodOperacionDesde($codOperacionDesde)
    {
        $this->codOperacionDesde = $codOperacionDesde;

        return $this;
    }

    /**
     * Get codOperacionDesde
     *
     * @return string 
     */
    public function getCodOperacionDesde()
    {
        return $this->codOperacionDesde;
    }

    /**
     * Set codOperacionHasta
     *
     * @param string $codOperacionHasta
     * @return CiexRestriccionesOperaciones
     */
    public function setCodOperacionHasta($codOperacionHasta)
    {
        $this->codOperacionHasta = $codOperacionHasta;

        return $this;
    }

    /**
     * Get codOperacionHasta
     *
     * @return string 
     */
    public function getCodOperacionHasta()
    {
        return $this->codOperacionHasta;
    }

    /**
     * Set restriccionOperacion
     *
     * @param boolean $restriccionOperacion
     * @return CiexRestriccionesOperaciones
     */
    public function setRestriccionOperacion($restriccionOperacion)
    {
        $this->restriccionOperacion = $restriccionOperacion;

        return $this;
    }

    /**
     * Get restriccionOperacion
     *
     * @return boolean 
     */
    public function getRestriccionOperacion()
    {
        return $this->restriccionOperacion;
    }

    /**
     * Get idCiexRestriccionOperaciones
     *
     * @return integer 
     */
    public function getIdCiexRestriccionOperaciones()
    {
        return $this->idCiexRestriccionOperaciones;
    }

    /**
     * Set idOperacionHasta
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Operaciones $idOperacionHasta
     * @return CiexRestriccionesOperaciones
     */
    public function setIdOperacionHasta(\Guaycuru\DBHmi2Bundle\Entity\Operaciones $idOperacionHasta = null)
    {
        $this->idOperacionHasta = $idOperacionHasta;

        return $this;
    }

    /**
     * Get idOperacionHasta
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Operaciones 
     */
    public function getIdOperacionHasta()
    {
        return $this->idOperacionHasta;
    }

    /**
     * Set idOperacionDesde
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Operaciones $idOperacionDesde
     * @return CiexRestriccionesOperaciones
     */
    public function setIdOperacionDesde(\Guaycuru\DBHmi2Bundle\Entity\Operaciones $idOperacionDesde = null)
    {
        $this->idOperacionDesde = $idOperacionDesde;

        return $this;
    }

    /**
     * Get idOperacionDesde
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Operaciones 
     */
    public function getIdOperacionDesde()
    {
        return $this->idOperacionDesde;
    }

    /**
     * Set idCiexRestriccion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\CiexRestricciones $idCiexRestriccion
     * @return CiexRestriccionesOperaciones
     */
    public function setIdCiexRestriccion(\Guaycuru\DBHmi2Bundle\Entity\CiexRestricciones $idCiexRestriccion = null)
    {
        $this->idCiexRestriccion = $idCiexRestriccion;

        return $this;
    }

    /**
     * Get idCiexRestriccion
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\CiexRestricciones 
     */
    public function getIdCiexRestriccion()
    {
        return $this->idCiexRestriccion;
    }
}
