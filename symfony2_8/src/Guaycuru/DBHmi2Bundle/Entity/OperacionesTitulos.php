<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperacionesTitulos
 *
 * @ORM\Table(name="operaciones_titulos", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_descripcion", columns={"descripcion"}), @ORM\UniqueConstraint(name="idx_unique_desc_red", columns={"desc_red"})}, indexes={@ORM\Index(name="idx_fk_id_operacion_desde", columns={"id_operacion_desde"}), @ORM\Index(name="idx_fk_id_operacion_hasta", columns={"id_operacion_hasta"})})
 * @ORM\Entity
 */
class OperacionesTitulos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="capitulo", type="smallint", nullable=false)
     */
    private $capitulo;

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
     * @ORM\Column(name="id_operacion_titulo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOperacionTitulo;

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
     * Set capitulo
     *
     * @param integer $capitulo
     * @return OperacionesTitulos
     */
    public function setCapitulo($capitulo)
    {
        $this->capitulo = $capitulo;

        return $this;
    }

    /**
     * Get capitulo
     *
     * @return integer 
     */
    public function getCapitulo()
    {
        return $this->capitulo;
    }

    /**
     * Set codOperacionDesde
     *
     * @param string $codOperacionDesde
     * @return OperacionesTitulos
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
     * @return OperacionesTitulos
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return OperacionesTitulos
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
     * @return OperacionesTitulos
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
     * Get idOperacionTitulo
     *
     * @return integer 
     */
    public function getIdOperacionTitulo()
    {
        return $this->idOperacionTitulo;
    }

    /**
     * Set idOperacionHasta
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Operaciones $idOperacionHasta
     * @return OperacionesTitulos
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
     * @return OperacionesTitulos
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
}
