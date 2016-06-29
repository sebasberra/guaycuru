<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CiexRestricciones
 *
 * @ORM\Table(name="ciex_restricciones", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_ciex_3_fecha_vigencia_desde", columns={"id_ciex_3", "fecha_vigencia_desde"}), @ORM\UniqueConstraint(name="idx_unique_id_ciex_4_fecha_vigencia_desde", columns={"id_ciex_4", "fecha_vigencia_desde"}), @ORM\UniqueConstraint(name="idx_unique_id_ciex_titulo_fecha_vigencia_desde", columns={"id_ciex_titulo", "fecha_vigencia_desde"})}, indexes={@ORM\Index(name="idx_fk_ciex_3_id_ciex_3", columns={"id_ciex_3"}), @ORM\Index(name="idx_fk_ciex_4_id_ciex_4", columns={"id_ciex_4"}), @ORM\Index(name="idx_fk_ciex_titulos_id_ciex_titulo", columns={"id_ciex_titulo"}), @ORM\Index(name="idx_cod_3dig", columns={"cod_3dig"}), @ORM\Index(name="idx_cod_4dig", columns={"cod_4dig"}), @ORM\Index(name="idx_fecha_vigencia_desde", columns={"fecha_vigencia_desde"}), @ORM\Index(name="idx_fecha_vigencia_hasta", columns={"fecha_vigencia_hasta"})})
 * @ORM\Entity
 */
class CiexRestricciones
{
    /**
     * @var string
     *
     * @ORM\Column(name="cod_3dig", type="string", length=3, nullable=true)
     */
    private $cod3dig;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_4dig", type="string", length=1, nullable=true)
     */
    private $cod4dig;

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
     * @var boolean
     *
     * @ORM\Column(name="obstetricia", type="boolean", nullable=false)
     */
    private $obstetricia;

    /**
     * @var boolean
     *
     * @ORM\Column(name="defuncion", type="boolean", nullable=false)
     */
    private $defuncion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="causa_externa", type="boolean", nullable=false)
     */
    private $causaExterna;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vigencia_desde", type="date", nullable=false)
     */
    private $fechaVigenciaDesde;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vigencia_hasta", type="date", nullable=true)
     */
    private $fechaVigenciaHasta;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ciex_restriccion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiexRestriccion;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\CiexTitulos
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\CiexTitulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_titulo", referencedColumnName="id_ciex_titulo")
     * })
     */
    private $idCiexTitulo;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex4
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex4")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_4", referencedColumnName="id_ciex_4")
     * })
     */
    private $idCiex4;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex3
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex3")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_3", referencedColumnName="id_ciex_3")
     * })
     */
    private $idCiex3;



    /**
     * Set cod3dig
     *
     * @param string $cod3dig
     * @return CiexRestricciones
     */
    public function setCod3dig($cod3dig)
    {
        $this->cod3dig = $cod3dig;

        return $this;
    }

    /**
     * Get cod3dig
     *
     * @return string 
     */
    public function getCod3dig()
    {
        return $this->cod3dig;
    }

    /**
     * Set cod4dig
     *
     * @param string $cod4dig
     * @return CiexRestricciones
     */
    public function setCod4dig($cod4dig)
    {
        $this->cod4dig = $cod4dig;

        return $this;
    }

    /**
     * Get cod4dig
     *
     * @return string 
     */
    public function getCod4dig()
    {
        return $this->cod4dig;
    }

    /**
     * Set sexo
     *
     * @param boolean $sexo
     * @return CiexRestricciones
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
     * @return CiexRestricciones
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
     * @return CiexRestricciones
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
     * @return CiexRestricciones
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
     * @return CiexRestricciones
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
     * @return CiexRestricciones
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
     * @return CiexRestricciones
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
     * Set obstetricia
     *
     * @param boolean $obstetricia
     * @return CiexRestricciones
     */
    public function setObstetricia($obstetricia)
    {
        $this->obstetricia = $obstetricia;

        return $this;
    }

    /**
     * Get obstetricia
     *
     * @return boolean 
     */
    public function getObstetricia()
    {
        return $this->obstetricia;
    }

    /**
     * Set defuncion
     *
     * @param boolean $defuncion
     * @return CiexRestricciones
     */
    public function setDefuncion($defuncion)
    {
        $this->defuncion = $defuncion;

        return $this;
    }

    /**
     * Get defuncion
     *
     * @return boolean 
     */
    public function getDefuncion()
    {
        return $this->defuncion;
    }

    /**
     * Set causaExterna
     *
     * @param boolean $causaExterna
     * @return CiexRestricciones
     */
    public function setCausaExterna($causaExterna)
    {
        $this->causaExterna = $causaExterna;

        return $this;
    }

    /**
     * Get causaExterna
     *
     * @return boolean 
     */
    public function getCausaExterna()
    {
        return $this->causaExterna;
    }

    /**
     * Set fechaVigenciaDesde
     *
     * @param \DateTime $fechaVigenciaDesde
     * @return CiexRestricciones
     */
    public function setFechaVigenciaDesde($fechaVigenciaDesde)
    {
        $this->fechaVigenciaDesde = $fechaVigenciaDesde;

        return $this;
    }

    /**
     * Get fechaVigenciaDesde
     *
     * @return \DateTime 
     */
    public function getFechaVigenciaDesde()
    {
        return $this->fechaVigenciaDesde;
    }

    /**
     * Set fechaVigenciaHasta
     *
     * @param \DateTime $fechaVigenciaHasta
     * @return CiexRestricciones
     */
    public function setFechaVigenciaHasta($fechaVigenciaHasta)
    {
        $this->fechaVigenciaHasta = $fechaVigenciaHasta;

        return $this;
    }

    /**
     * Get fechaVigenciaHasta
     *
     * @return \DateTime 
     */
    public function getFechaVigenciaHasta()
    {
        return $this->fechaVigenciaHasta;
    }

    /**
     * Get idCiexRestriccion
     *
     * @return integer 
     */
    public function getIdCiexRestriccion()
    {
        return $this->idCiexRestriccion;
    }

    /**
     * Set idCiexTitulo
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\CiexTitulos $idCiexTitulo
     * @return CiexRestricciones
     */
    public function setIdCiexTitulo(\Guaycuru\DBHmi2Bundle\Entity\CiexTitulos $idCiexTitulo = null)
    {
        $this->idCiexTitulo = $idCiexTitulo;

        return $this;
    }

    /**
     * Get idCiexTitulo
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\CiexTitulos 
     */
    public function getIdCiexTitulo()
    {
        return $this->idCiexTitulo;
    }

    /**
     * Set idCiex4
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex4 $idCiex4
     * @return CiexRestricciones
     */
    public function setIdCiex4(\Guaycuru\DBHmi2Bundle\Entity\Ciex4 $idCiex4 = null)
    {
        $this->idCiex4 = $idCiex4;

        return $this;
    }

    /**
     * Get idCiex4
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Ciex4 
     */
    public function getIdCiex4()
    {
        return $this->idCiex4;
    }

    /**
     * Set idCiex3
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3
     * @return CiexRestricciones
     */
    public function setIdCiex3(\Guaycuru\DBHmi2Bundle\Entity\Ciex3 $idCiex3 = null)
    {
        $this->idCiex3 = $idCiex3;

        return $this;
    }

    /**
     * Get idCiex3
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Ciex3 
     */
    public function getIdCiex3()
    {
        return $this->idCiex3;
    }
}
