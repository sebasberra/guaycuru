<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CodigosHmi
 *
 * @ORM\Table(name="codigos_hmi", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_codigo_hmi_tipo_codigo", columns={"codigo_hmi", "tipo_codigo"})})
 * @ORM\Entity
 */
class CodigosHmi
{
    /**
     * @var string
     *
     * @ORM\Column(name="codigo_hmi", type="string", length=2, nullable=false)
     */
    private $codigoHmi;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=50, nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_codigo", type="integer", nullable=false)
     */
    private $tipoCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="desc_tipo_codigo", type="string", length=50, nullable=false)
     */
    private $descTipoCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="restriccion", type="string", length=1, nullable=true)
     */
    private $restriccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_codigo_hmi", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCodigoHmi;



    /**
     * Set codigoHmi
     *
     * @param string $codigoHmi
     * @return CodigosHmi
     */
    public function setCodigoHmi($codigoHmi)
    {
        $this->codigoHmi = $codigoHmi;

        return $this;
    }

    /**
     * Get codigoHmi
     *
     * @return string 
     */
    public function getCodigoHmi()
    {
        return $this->codigoHmi;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return CodigosHmi
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
     * Set tipoCodigo
     *
     * @param integer $tipoCodigo
     * @return CodigosHmi
     */
    public function setTipoCodigo($tipoCodigo)
    {
        $this->tipoCodigo = $tipoCodigo;

        return $this;
    }

    /**
     * Get tipoCodigo
     *
     * @return integer 
     */
    public function getTipoCodigo()
    {
        return $this->tipoCodigo;
    }

    /**
     * Set descTipoCodigo
     *
     * @param string $descTipoCodigo
     * @return CodigosHmi
     */
    public function setDescTipoCodigo($descTipoCodigo)
    {
        $this->descTipoCodigo = $descTipoCodigo;

        return $this;
    }

    /**
     * Get descTipoCodigo
     *
     * @return string 
     */
    public function getDescTipoCodigo()
    {
        return $this->descTipoCodigo;
    }

    /**
     * Set restriccion
     *
     * @param string $restriccion
     * @return CodigosHmi
     */
    public function setRestriccion($restriccion)
    {
        $this->restriccion = $restriccion;

        return $this;
    }

    /**
     * Get restriccion
     *
     * @return string 
     */
    public function getRestriccion()
    {
        return $this->restriccion;
    }

    /**
     * Get idCodigoHmi
     *
     * @return integer 
     */
    public function getIdCodigoHmi()
    {
        return $this->idCodigoHmi;
    }
}
