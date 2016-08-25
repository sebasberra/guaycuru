<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServiciosEstadistica
 *
 * @ORM\Table(name="servicios_estadistica", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_servicio_sector_subsector", columns={"cod_servicio", "sector", "subsector"})}, indexes={@ORM\Index(name="idx_fk_servicios_estadistica_id_servicio", columns={"id_servicio"})})
 * @ORM\Entity
 */
class ServiciosEstadistica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_servicio_estadistica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idServicioEstadistica;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_servicio", type="integer", nullable=false)
     */
    private $idServicio;

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
     * @var string
     *
     * @ORM\Column(name="nom_red_servicio_estadistica", type="string", length=30, nullable=false)
     */
    private $nomRedServicioEstadistica;



    /**
     * Get idServicioEstadistica
     *
     * @return integer 
     */
    public function getIdServicioEstadistica()
    {
        return $this->idServicioEstadistica;
    }

    /**
     * Set idServicio
     *
     * @param integer $idServicio
     * @return ServiciosEstadistica
     */
    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;

        return $this;
    }

    /**
     * Get idServicio
     *
     * @return integer 
     */
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    /**
     * Set codServicio
     *
     * @param string $codServicio
     * @return ServiciosEstadistica
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
     * @return ServiciosEstadistica
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
     * @return ServiciosEstadistica
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
     * @return ServiciosEstadistica
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
     * Set nomRedServicioEstadistica
     *
     * @param string $nomRedServicioEstadistica
     * @return ServiciosEstadistica
     */
    public function setNomRedServicioEstadistica($nomRedServicioEstadistica)
    {
        $this->nomRedServicioEstadistica = $nomRedServicioEstadistica;

        return $this;
    }

    /**
     * Get nomRedServicioEstadistica
     *
     * @return string 
     */
    public function getNomRedServicioEstadistica()
    {
        return $this->nomRedServicioEstadistica;
    }
}
