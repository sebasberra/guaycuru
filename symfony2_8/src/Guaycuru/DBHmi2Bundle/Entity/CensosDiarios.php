<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CensosDiarios
 *
 * @ORM\Table(name="censos_diarios", indexes={@ORM\Index(name="idx_fecha_censo", columns={"fecha_censo"}), @ORM\Index(name="idx_id_efector_servicio", columns={"id_efector_servicio"}), @ORM\Index(name="idx_id_sala", columns={"id_sala"})})
 * @ORM\Entity
 */
class CensosDiarios
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_censo", type="date", nullable=false)
     */
    private $fechaCenso;

    /**
     * @var integer
     *
     * @ORM\Column(name="existencia_0", type="smallint", nullable=false)
     */
    private $existencia0;

    /**
     * @var integer
     *
     * @ORM\Column(name="ingresos", type="smallint", nullable=false)
     */
    private $ingresos;

    /**
     * @var integer
     *
     * @ORM\Column(name="pases_de", type="smallint", nullable=false)
     */
    private $pasesDe;

    /**
     * @var integer
     *
     * @ORM\Column(name="pases_de_servicios", type="smallint", nullable=false)
     */
    private $pasesDeServicios;

    /**
     * @var integer
     *
     * @ORM\Column(name="altas", type="smallint", nullable=false)
     */
    private $altas;

    /**
     * @var integer
     *
     * @ORM\Column(name="defunciones_menos_48", type="smallint", nullable=false)
     */
    private $defuncionesMenos48;

    /**
     * @var integer
     *
     * @ORM\Column(name="defunciones_mas_48", type="smallint", nullable=false)
     */
    private $defuncionesMas48;

    /**
     * @var integer
     *
     * @ORM\Column(name="pases_a", type="smallint", nullable=false)
     */
    private $pasesA;

    /**
     * @var integer
     *
     * @ORM\Column(name="pases_a_servicios", type="smallint", nullable=false)
     */
    private $pasesAServicios;

    /**
     * @var integer
     *
     * @ORM\Column(name="existencia_24", type="smallint", nullable=false)
     */
    private $existencia24;

    /**
     * @var integer
     *
     * @ORM\Column(name="entradas_salidas_dia", type="smallint", nullable=false)
     */
    private $entradasSalidasDia;

    /**
     * @var integer
     *
     * @ORM\Column(name="pacientes_dia", type="smallint", nullable=false)
     */
    private $pacientesDia;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_estada", type="smallint", nullable=false)
     */
    private $diasEstada;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_camas_sala", type="smallint", nullable=false)
     */
    private $totalCamasSala;

    /**
     * @var integer
     *
     * @ORM\Column(name="camas_disponibles", type="smallint", nullable=false)
     */
    private $camasDisponibles;

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
     * @ORM\Column(name="id_censo_diario", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCensoDiario;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\EfectoresServicios
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\EfectoresServicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector_servicio", referencedColumnName="id_efector_servicio")
     * })
     */
    private $idEfectorServicio;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Salas
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Salas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sala", referencedColumnName="id_sala")
     * })
     */
    private $idSala;



    /**
     * Set fechaCenso
     *
     * @param \DateTime $fechaCenso
     * @return CensosDiarios
     */
    public function setFechaCenso($fechaCenso)
    {
        $this->fechaCenso = $fechaCenso;

        return $this;
    }

    /**
     * Get fechaCenso
     *
     * @return \DateTime 
     */
    public function getFechaCenso()
    {
        return $this->fechaCenso;
    }

    /**
     * Set existencia0
     *
     * @param integer $existencia0
     * @return CensosDiarios
     */
    public function setExistencia0($existencia0)
    {
        $this->existencia0 = $existencia0;

        return $this;
    }

    /**
     * Get existencia0
     *
     * @return integer 
     */
    public function getExistencia0()
    {
        return $this->existencia0;
    }

    /**
     * Set ingresos
     *
     * @param integer $ingresos
     * @return CensosDiarios
     */
    public function setIngresos($ingresos)
    {
        $this->ingresos = $ingresos;

        return $this;
    }

    /**
     * Get ingresos
     *
     * @return integer 
     */
    public function getIngresos()
    {
        return $this->ingresos;
    }

    /**
     * Set pasesDe
     *
     * @param integer $pasesDe
     * @return CensosDiarios
     */
    public function setPasesDe($pasesDe)
    {
        $this->pasesDe = $pasesDe;

        return $this;
    }

    /**
     * Get pasesDe
     *
     * @return integer 
     */
    public function getPasesDe()
    {
        return $this->pasesDe;
    }

    /**
     * Set pasesDeServicios
     *
     * @param integer $pasesDeServicios
     * @return CensosDiarios
     */
    public function setPasesDeServicios($pasesDeServicios)
    {
        $this->pasesDeServicios = $pasesDeServicios;

        return $this;
    }

    /**
     * Get pasesDeServicios
     *
     * @return integer 
     */
    public function getPasesDeServicios()
    {
        return $this->pasesDeServicios;
    }

    /**
     * Set altas
     *
     * @param integer $altas
     * @return CensosDiarios
     */
    public function setAltas($altas)
    {
        $this->altas = $altas;

        return $this;
    }

    /**
     * Get altas
     *
     * @return integer 
     */
    public function getAltas()
    {
        return $this->altas;
    }

    /**
     * Set defuncionesMenos48
     *
     * @param integer $defuncionesMenos48
     * @return CensosDiarios
     */
    public function setDefuncionesMenos48($defuncionesMenos48)
    {
        $this->defuncionesMenos48 = $defuncionesMenos48;

        return $this;
    }

    /**
     * Get defuncionesMenos48
     *
     * @return integer 
     */
    public function getDefuncionesMenos48()
    {
        return $this->defuncionesMenos48;
    }

    /**
     * Set defuncionesMas48
     *
     * @param integer $defuncionesMas48
     * @return CensosDiarios
     */
    public function setDefuncionesMas48($defuncionesMas48)
    {
        $this->defuncionesMas48 = $defuncionesMas48;

        return $this;
    }

    /**
     * Get defuncionesMas48
     *
     * @return integer 
     */
    public function getDefuncionesMas48()
    {
        return $this->defuncionesMas48;
    }

    /**
     * Set pasesA
     *
     * @param integer $pasesA
     * @return CensosDiarios
     */
    public function setPasesA($pasesA)
    {
        $this->pasesA = $pasesA;

        return $this;
    }

    /**
     * Get pasesA
     *
     * @return integer 
     */
    public function getPasesA()
    {
        return $this->pasesA;
    }

    /**
     * Set pasesAServicios
     *
     * @param integer $pasesAServicios
     * @return CensosDiarios
     */
    public function setPasesAServicios($pasesAServicios)
    {
        $this->pasesAServicios = $pasesAServicios;

        return $this;
    }

    /**
     * Get pasesAServicios
     *
     * @return integer 
     */
    public function getPasesAServicios()
    {
        return $this->pasesAServicios;
    }

    /**
     * Set existencia24
     *
     * @param integer $existencia24
     * @return CensosDiarios
     */
    public function setExistencia24($existencia24)
    {
        $this->existencia24 = $existencia24;

        return $this;
    }

    /**
     * Get existencia24
     *
     * @return integer 
     */
    public function getExistencia24()
    {
        return $this->existencia24;
    }

    /**
     * Set entradasSalidasDia
     *
     * @param integer $entradasSalidasDia
     * @return CensosDiarios
     */
    public function setEntradasSalidasDia($entradasSalidasDia)
    {
        $this->entradasSalidasDia = $entradasSalidasDia;

        return $this;
    }

    /**
     * Get entradasSalidasDia
     *
     * @return integer 
     */
    public function getEntradasSalidasDia()
    {
        return $this->entradasSalidasDia;
    }

    /**
     * Set pacientesDia
     *
     * @param integer $pacientesDia
     * @return CensosDiarios
     */
    public function setPacientesDia($pacientesDia)
    {
        $this->pacientesDia = $pacientesDia;

        return $this;
    }

    /**
     * Get pacientesDia
     *
     * @return integer 
     */
    public function getPacientesDia()
    {
        return $this->pacientesDia;
    }

    /**
     * Set diasEstada
     *
     * @param integer $diasEstada
     * @return CensosDiarios
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
     * Set totalCamasSala
     *
     * @param integer $totalCamasSala
     * @return CensosDiarios
     */
    public function setTotalCamasSala($totalCamasSala)
    {
        $this->totalCamasSala = $totalCamasSala;

        return $this;
    }

    /**
     * Get totalCamasSala
     *
     * @return integer 
     */
    public function getTotalCamasSala()
    {
        return $this->totalCamasSala;
    }

    /**
     * Set camasDisponibles
     *
     * @param integer $camasDisponibles
     * @return CensosDiarios
     */
    public function setCamasDisponibles($camasDisponibles)
    {
        $this->camasDisponibles = $camasDisponibles;

        return $this;
    }

    /**
     * Get camasDisponibles
     *
     * @return integer 
     */
    public function getCamasDisponibles()
    {
        return $this->camasDisponibles;
    }

    /**
     * Set baja
     *
     * @param boolean $baja
     * @return CensosDiarios
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
     * @return CensosDiarios
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
     * Get idCensoDiario
     *
     * @return integer 
     */
    public function getIdCensoDiario()
    {
        return $this->idCensoDiario;
    }

    /**
     * Set idEfectorServicio
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\EfectoresServicios $idEfectorServicio
     * @return CensosDiarios
     */
    public function setIdEfectorServicio(\Guaycuru\DBHmi2Bundle\Entity\EfectoresServicios $idEfectorServicio = null)
    {
        $this->idEfectorServicio = $idEfectorServicio;

        return $this;
    }

    /**
     * Get idEfectorServicio
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\EfectoresServicios 
     */
    public function getIdEfectorServicio()
    {
        return $this->idEfectorServicio;
    }

    /**
     * Set idSala
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Salas $idSala
     * @return CensosDiarios
     */
    public function setIdSala(\Guaycuru\DBHmi2Bundle\Entity\Salas $idSala = null)
    {
        $this->idSala = $idSala;

        return $this;
    }

    /**
     * Get idSala
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Salas 
     */
    public function getIdSala()
    {
        return $this->idSala;
    }
}
