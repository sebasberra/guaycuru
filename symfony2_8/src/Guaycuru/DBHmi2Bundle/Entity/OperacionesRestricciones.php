<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperacionesRestricciones
 *
 * @ORM\Table(name="operaciones_restricciones", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_operacion", columns={"cod_operacion"})})
 * @ORM\Entity
 */
class OperacionesRestricciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_operacion", type="integer", nullable=false)
     */
    private $idOperacion;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_operacion", type="string", length=4, nullable=false)
     */
    private $codOperacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexo", type="boolean", nullable=false)
     */
    private $sexo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="frecuencia", type="boolean", nullable=false)
     */
    private $frecuencia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipoedad_min", type="boolean", nullable=false)
     */
    private $tipoedadMin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="edad_min", type="boolean", nullable=false)
     */
    private $edadMin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipoedad_max", type="boolean", nullable=false)
     */
    private $tipoedadMax;

    /**
     * @var boolean
     *
     * @ORM\Column(name="edad_max", type="boolean", nullable=false)
     */
    private $edadMax;

    /**
     * @var boolean
     *
     * @ORM\Column(name="restriccion_edad", type="boolean", nullable=false)
     */
    private $restriccionEdad;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_operacion_restriccion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOperacionRestriccion;



    /**
     * Set idOperacion
     *
     * @param integer $idOperacion
     * @return OperacionesRestricciones
     */
    public function setIdOperacion($idOperacion)
    {
        $this->idOperacion = $idOperacion;

        return $this;
    }

    /**
     * Get idOperacion
     *
     * @return integer 
     */
    public function getIdOperacion()
    {
        return $this->idOperacion;
    }

    /**
     * Set codOperacion
     *
     * @param string $codOperacion
     * @return OperacionesRestricciones
     */
    public function setCodOperacion($codOperacion)
    {
        $this->codOperacion = $codOperacion;

        return $this;
    }

    /**
     * Get codOperacion
     *
     * @return string 
     */
    public function getCodOperacion()
    {
        return $this->codOperacion;
    }

    /**
     * Set sexo
     *
     * @param boolean $sexo
     * @return OperacionesRestricciones
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return boolean 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set frecuencia
     *
     * @param boolean $frecuencia
     * @return OperacionesRestricciones
     */
    public function setFrecuencia($frecuencia)
    {
        $this->frecuencia = $frecuencia;

        return $this;
    }

    /**
     * Get frecuencia
     *
     * @return boolean 
     */
    public function getFrecuencia()
    {
        return $this->frecuencia;
    }

    /**
     * Set tipoedadMin
     *
     * @param boolean $tipoedadMin
     * @return OperacionesRestricciones
     */
    public function setTipoedadMin($tipoedadMin)
    {
        $this->tipoedadMin = $tipoedadMin;

        return $this;
    }

    /**
     * Get tipoedadMin
     *
     * @return boolean 
     */
    public function getTipoedadMin()
    {
        return $this->tipoedadMin;
    }

    /**
     * Set edadMin
     *
     * @param boolean $edadMin
     * @return OperacionesRestricciones
     */
    public function setEdadMin($edadMin)
    {
        $this->edadMin = $edadMin;

        return $this;
    }

    /**
     * Get edadMin
     *
     * @return boolean 
     */
    public function getEdadMin()
    {
        return $this->edadMin;
    }

    /**
     * Set tipoedadMax
     *
     * @param boolean $tipoedadMax
     * @return OperacionesRestricciones
     */
    public function setTipoedadMax($tipoedadMax)
    {
        $this->tipoedadMax = $tipoedadMax;

        return $this;
    }

    /**
     * Get tipoedadMax
     *
     * @return boolean 
     */
    public function getTipoedadMax()
    {
        return $this->tipoedadMax;
    }

    /**
     * Set edadMax
     *
     * @param boolean $edadMax
     * @return OperacionesRestricciones
     */
    public function setEdadMax($edadMax)
    {
        $this->edadMax = $edadMax;

        return $this;
    }

    /**
     * Get edadMax
     *
     * @return boolean 
     */
    public function getEdadMax()
    {
        return $this->edadMax;
    }

    /**
     * Set restriccionEdad
     *
     * @param boolean $restriccionEdad
     * @return OperacionesRestricciones
     */
    public function setRestriccionEdad($restriccionEdad)
    {
        $this->restriccionEdad = $restriccionEdad;

        return $this;
    }

    /**
     * Get restriccionEdad
     *
     * @return boolean 
     */
    public function getRestriccionEdad()
    {
        return $this->restriccionEdad;
    }

    /**
     * Get idOperacionRestriccion
     *
     * @return integer 
     */
    public function getIdOperacionRestriccion()
    {
        return $this->idOperacionRestriccion;
    }
}
