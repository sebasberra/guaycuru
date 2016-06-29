<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pases
 *
 * @ORM\Table(name="pases", indexes={@ORM\Index(name="fk_id_internacion", columns={"id_internacion"}), @ORM\Index(name="fk_id_servicio_sala_entrada", columns={"id_servicio_sala_entrada"}), @ORM\Index(name="fk_id_servicio_sala_salida", columns={"id_servicio_sala_salida"}), @ORM\Index(name="fk_id_cama", columns={"id_cama"}), @ORM\Index(name="fk_id_censo_diario", columns={"id_censo_diario"}), @ORM\Index(name="fk_id_pase_siguiente", columns={"id_pase_siguiente"}), @ORM\Index(name="idx_fecha_entrada", columns={"fecha_entrada"}), @ORM\Index(name="idx_fecha_salida", columns={"fecha_salida"}), @ORM\Index(name="fk_id_habitacion", columns={"id_habitacion"})})
 * @ORM\Entity
 */
class Pases
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrada", type="datetime", nullable=false)
     */
    private $fechaEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_entrada", type="string", length=1, nullable=false)
     */
    private $tipoEntrada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_salida", type="datetime", nullable=true)
     */
    private $fechaSalida;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_salida", type="string", length=1, nullable=true)
     */
    private $tipoSalida;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_estada", type="smallint", nullable=false)
     */
    private $diasEstada;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_pase", type="string", length=1, nullable=false)
     */
    private $estadoPase;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_pase", type="text", length=65535, nullable=true)
     */
    private $observacionPase;

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
     * @ORM\Column(name="id_pase", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPase;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\CensosDiarios
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\CensosDiarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_censo_diario", referencedColumnName="id_censo_diario")
     * })
     */
    private $idCensoDiario;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Pases
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Pases")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pase_siguiente", referencedColumnName="id_pase")
     * })
     */
    private $idPaseSiguiente;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Camas
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Camas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cama", referencedColumnName="id_cama")
     * })
     */
    private $idCama;

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
     * @var \Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_sala_entrada", referencedColumnName="id_servicio_sala")
     * })
     */
    private $idServicioSalaEntrada;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_sala_salida", referencedColumnName="id_servicio_sala")
     * })
     */
    private $idServicioSalaSalida;

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
     * Set fechaEntrada
     *
     * @param \DateTime $fechaEntrada
     * @return Pases
     */
    public function setFechaEntrada($fechaEntrada)
    {
        $this->fechaEntrada = $fechaEntrada;

        return $this;
    }

    /**
     * Get fechaEntrada
     *
     * @return \DateTime 
     */
    public function getFechaEntrada()
    {
        return $this->fechaEntrada;
    }

    /**
     * Set tipoEntrada
     *
     * @param string $tipoEntrada
     * @return Pases
     */
    public function setTipoEntrada($tipoEntrada)
    {
        $this->tipoEntrada = $tipoEntrada;

        return $this;
    }

    /**
     * Get tipoEntrada
     *
     * @return string 
     */
    public function getTipoEntrada()
    {
        return $this->tipoEntrada;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     * @return Pases
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime 
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set tipoSalida
     *
     * @param string $tipoSalida
     * @return Pases
     */
    public function setTipoSalida($tipoSalida)
    {
        $this->tipoSalida = $tipoSalida;

        return $this;
    }

    /**
     * Get tipoSalida
     *
     * @return string 
     */
    public function getTipoSalida()
    {
        return $this->tipoSalida;
    }

    /**
     * Set diasEstada
     *
     * @param integer $diasEstada
     * @return Pases
     */
    public function setDiasEstada($diasEstada)
    {
        $this->diasEstada = $diasEstada;

        return $this;
    }

    /**
     * Get diasEstada
     *
     * @return integer 
     */
    public function getDiasEstada()
    {
        return $this->diasEstada;
    }

    /**
     * Set estadoPase
     *
     * @param string $estadoPase
     * @return Pases
     */
    public function setEstadoPase($estadoPase)
    {
        $this->estadoPase = $estadoPase;

        return $this;
    }

    /**
     * Get estadoPase
     *
     * @return string 
     */
    public function getEstadoPase()
    {
        return $this->estadoPase;
    }

    /**
     * Set observacionPase
     *
     * @param string $observacionPase
     * @return Pases
     */
    public function setObservacionPase($observacionPase)
    {
        $this->observacionPase = $observacionPase;

        return $this;
    }

    /**
     * Get observacionPase
     *
     * @return string 
     */
    public function getObservacionPase()
    {
        return $this->observacionPase;
    }

    /**
     * Set baja
     *
     * @param boolean $baja
     * @return Pases
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
     * @return Pases
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
     * Get idPase
     *
     * @return integer 
     */
    public function getIdPase()
    {
        return $this->idPase;
    }

    /**
     * Set idCensoDiario
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\CensosDiarios $idCensoDiario
     * @return Pases
     */
    public function setIdCensoDiario(\Guaycuru\DBHmi2Bundle\Entity\CensosDiarios $idCensoDiario = null)
    {
        $this->idCensoDiario = $idCensoDiario;

        return $this;
    }

    /**
     * Get idCensoDiario
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\CensosDiarios 
     */
    public function getIdCensoDiario()
    {
        return $this->idCensoDiario;
    }

    /**
     * Set idPaseSiguiente
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Pases $idPaseSiguiente
     * @return Pases
     */
    public function setIdPaseSiguiente(\Guaycuru\DBHmi2Bundle\Entity\Pases $idPaseSiguiente = null)
    {
        $this->idPaseSiguiente = $idPaseSiguiente;

        return $this;
    }

    /**
     * Get idPaseSiguiente
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Pases 
     */
    public function getIdPaseSiguiente()
    {
        return $this->idPaseSiguiente;
    }

    /**
     * Set idCama
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Camas $idCama
     * @return Pases
     */
    public function setIdCama(\Guaycuru\DBHmi2Bundle\Entity\Camas $idCama = null)
    {
        $this->idCama = $idCama;

        return $this;
    }

    /**
     * Get idCama
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Camas 
     */
    public function getIdCama()
    {
        return $this->idCama;
    }

    /**
     * Set idHabitacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Habitaciones $idHabitacion
     * @return Pases
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

    /**
     * Set idServicioSalaEntrada
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas $idServicioSalaEntrada
     * @return Pases
     */
    public function setIdServicioSalaEntrada(\Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas $idServicioSalaEntrada = null)
    {
        $this->idServicioSalaEntrada = $idServicioSalaEntrada;

        return $this;
    }

    /**
     * Get idServicioSalaEntrada
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas 
     */
    public function getIdServicioSalaEntrada()
    {
        return $this->idServicioSalaEntrada;
    }

    /**
     * Set idServicioSalaSalida
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas $idServicioSalaSalida
     * @return Pases
     */
    public function setIdServicioSalaSalida(\Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas $idServicioSalaSalida = null)
    {
        $this->idServicioSalaSalida = $idServicioSalaSalida;

        return $this;
    }

    /**
     * Get idServicioSalaSalida
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\ServiciosSalas 
     */
    public function getIdServicioSalaSalida()
    {
        return $this->idServicioSalaSalida;
    }

    /**
     * Set idInternacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Internaciones $idInternacion
     * @return Pases
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
