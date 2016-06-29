<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EfectoresServicios
 *
 * @ORM\Table(name="efectores_servicios", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_claveestd_cod_servicio_sector_subsector", columns={"claveestd", "cod_servicio", "sector", "subsector", "fecha_apertura"})}, indexes={@ORM\Index(name="fk_id_efector", columns={"id_efector"}), @ORM\Index(name="fk_id_servicio_estadistica", columns={"id_servicio_estadistica"})})
 * @ORM\Entity
 */
class EfectoresServicios
{
    /**
     * @var string
     *
     * @ORM\Column(name="claveestd", type="string", length=8, nullable=false)
     */
    private $claveestd;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_servicio", type="string", length=3, nullable=false)
     */
    private $codServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="sector", type="string", length=1, nullable=false)
     */
    private $sector;

    /**
     * @var string
     *
     * @ORM\Column(name="subsector", type="string", length=1, nullable=false)
     */
    private $subsector;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_servicio_estadistica", type="string", length=255, nullable=false)
     */
    private $nomServicioEstadistica;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_apertura", type="date", nullable=false)
     */
    private $fechaApertura;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="date", nullable=true)
     */
    private $fechaCierre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_efector_servicio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEfectorServicio;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_estadistica", referencedColumnName="id_servicio_estadistica")
     * })
     */
    private $idServicioEstadistica;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Efectores
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     */
    private $idEfector;



    /**
     * Set claveestd
     *
     * @param string $claveestd
     * @return EfectoresServicios
     */
    public function setClaveestd($claveestd)
    {
        $this->claveestd = $claveestd;

        return $this;
    }

    /**
     * Get claveestd
     *
     * @return string 
     */
    public function getClaveestd()
    {
        return $this->claveestd;
    }

    /**
     * Set codServicio
     *
     * @param string $codServicio
     * @return EfectoresServicios
     */
    public function setCodServicio($codServicio)
    {
        $this->codServicio = $codServicio;

        return $this;
    }

    /**
     * Get codServicio
     *
     * @return string 
     */
    public function getCodServicio()
    {
        return $this->codServicio;
    }

    /**
     * Set sector
     *
     * @param string $sector
     * @return EfectoresServicios
     */
    public function setSector($sector)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector
     *
     * @return string 
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set subsector
     *
     * @param string $subsector
     * @return EfectoresServicios
     */
    public function setSubsector($subsector)
    {
        $this->subsector = $subsector;

        return $this;
    }

    /**
     * Get subsector
     *
     * @return string 
     */
    public function getSubsector()
    {
        return $this->subsector;
    }

    /**
     * Set nomServicioEstadistica
     *
     * @param string $nomServicioEstadistica
     * @return EfectoresServicios
     */
    public function setNomServicioEstadistica($nomServicioEstadistica)
    {
        $this->nomServicioEstadistica = $nomServicioEstadistica;

        return $this;
    }

    /**
     * Get nomServicioEstadistica
     *
     * @return string 
     */
    public function getNomServicioEstadistica()
    {
        return $this->nomServicioEstadistica;
    }

    /**
     * Set fechaApertura
     *
     * @param \DateTime $fechaApertura
     * @return EfectoresServicios
     */
    public function setFechaApertura($fechaApertura)
    {
        $this->fechaApertura = $fechaApertura;

        return $this;
    }

    /**
     * Get fechaApertura
     *
     * @return \DateTime 
     */
    public function getFechaApertura()
    {
        return $this->fechaApertura;
    }

    /**
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     * @return EfectoresServicios
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;

        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return \DateTime 
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return EfectoresServicios
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
     * Get idEfectorServicio
     *
     * @return integer 
     */
    public function getIdEfectorServicio()
    {
        return $this->idEfectorServicio;
    }

    /**
     * Set idServicioEstadistica
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica $idServicioEstadistica
     * @return EfectoresServicios
     */
    public function setIdServicioEstadistica(\Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica $idServicioEstadistica = null)
    {
        $this->idServicioEstadistica = $idServicioEstadistica;

        return $this;
    }

    /**
     * Get idServicioEstadistica
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\ServiciosEstadistica 
     */
    public function getIdServicioEstadistica()
    {
        return $this->idServicioEstadistica;
    }

    /**
     * Set idEfector
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Efectores $idEfector
     * @return EfectoresServicios
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
}
