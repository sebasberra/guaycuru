<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Salas
 *
 * @ORM\Table(name="salas", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_efector_nombre", columns={"id_efector", "nombre"}), @ORM\UniqueConstraint(name="idx_unique_id_efector_nro_sala", columns={"id_efector", "nro_sala"}), @ORM\UniqueConstraint(name="idx_unique_id_efector_area_id_efector_servicio", columns={"area_id_efector_servicio"}), @ORM\UniqueConstraint(name="idx_unique_id_efector_cod_servicio_sector_subsector", columns={"id_efector", "area_cod_servicio", "area_sector", "area_subsector"})}, indexes={@ORM\Index(name="idx_fk_salas_area_id_efector_servicio", columns={"area_id_efector_servicio"}), @ORM\Index(name="IDX_FEDB5403305FE2F", columns={"id_efector"})})
 * @ORM\Entity(repositoryClass="RI\DBHmi2GuaycuruCamasBundle\Entity\SalasRepository")
 * 
 * @UniqueEntity(
 *     fields={"nombre", "idEfector"},
 *     message="El nombre de sala ya existe en el efector."
 * )
 * 
 */
class Salas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_sala", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSala;

    /**
     * @var integer
     *
     * @ORM\Column(name="nro_sala", type="smallint", nullable=false)
     */
    private $nroSala;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     * 
     * @Assert\Length(
     *      max = 255,
     *      maxMessage = "El nombre de sala no puede superar los 255 caracteres"
     * )
     * 
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_camas", type="smallint", nullable=false)
     * 
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "Cantidad de camas: {{ value }} no válido. La sala no puede tener un valor negativo de camas"
     * )
     * 
     */
    private $cantCamas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mover_camas", type="boolean", nullable=false)
     * 
     * @Assert\Type(
     *     type="bool",
     *     message="EL valor de permite mover camas: {{ value }} debe ser true o false."
     * )
     * 
     */
    private $moverCamas;

    /**
     * @var string
     *
     * @ORM\Column(name="area_cod_servicio", type="string", length=3, nullable=true)
     */
    private $areaCodServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="area_sector", type="string", length=1, nullable=true)
     */
    private $areaSector;

    /**
     * @var string
     *
     * @ORM\Column(name="area_subsector", type="string", length=1, nullable=true)
     */
    private $areaSubsector;

    /**
     * @var boolean
     *
     * @ORM\Column(name="baja", type="boolean", nullable=false)
     * 
     * @Assert\Type(
     *     type="bool",
     *     message="EL valor de baja: {{ value }} debe ser true o false."
     * )
     * 
     */
    private $baja;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion = 'CURRENT_TIMESTAMP';

    /**
     * @var \Efectores
     *
     * @ORM\ManyToOne(targetEntity="Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     */
    private $idEfector;

    /**
     * @var \EfectoresServicios
     *
     * @ORM\ManyToOne(targetEntity="EfectoresServicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="area_id_efector_servicio", referencedColumnName="id_efector_servicio")
     * })
     */
    private $areaEfectorServicio;



    /**
     * Get idSala
     *
     * @return integer
     */
    public function getIdSala()
    {
        return $this->idSala;
    }

    /**
     * Set nroSala
     *
     * @param integer $nroSala
     *
     * @return Salas
     */
    public function setNroSala($nroSala)
    {
        $this->nroSala = $nroSala;

        return $this;
    }

    /**
     * Get nroSala
     *
     * @return integer
     */
    public function getNroSala()
    {
        return $this->nroSala;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Salas
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set cantCamas
     *
     * @param integer $cantCamas
     *
     * @return Salas
     */
    public function setCantCamas($cantCamas)
    {
        $this->cantCamas = $cantCamas;

        return $this;
    }

    /**
     * Get cantCamas
     *
     * @return integer
     */
    public function getCantCamas()
    {
        return $this->cantCamas;
    }

    /**
     * Set moverCamas
     *
     * @param boolean $moverCamas
     *
     * @return Salas
     */
    public function setMoverCamas($moverCamas)
    {
        $this->moverCamas = $moverCamas;

        return $this;
    }

    /**
     * Get moverCamas
     *
     * @return boolean
     */
    public function getMoverCamas()
    {
        return $this->moverCamas;
    }

    /**
     * Set areaCodServicio
     *
     * @param string $areaCodServicio
     *
     * @return Salas
     */
    public function setAreaCodServicio($areaCodServicio)
    {
        $this->areaCodServicio = $areaCodServicio;

        return $this;
    }

    /**
     * Get areaCodServicio
     *
     * @return string
     */
    public function getAreaCodServicio()
    {
        return $this->areaCodServicio;
    }

    /**
     * Set areaSector
     *
     * @param string $areaSector
     *
     * @return Salas
     */
    public function setAreaSector($areaSector)
    {
        $this->areaSector = $areaSector;

        return $this;
    }

    /**
     * Get areaSector
     *
     * @return string
     */
    public function getAreaSector()
    {
        return $this->areaSector;
    }

    /**
     * Set areaSubsector
     *
     * @param string $areaSubsector
     *
     * @return Salas
     */
    public function setAreaSubsector($areaSubsector)
    {
        $this->areaSubsector = $areaSubsector;

        return $this;
    }

    /**
     * Get areaSubsector
     *
     * @return string
     */
    public function getAreaSubsector()
    {
        return $this->areaSubsector;
    }

    /**
     * Set baja
     *
     * @param boolean $baja
     *
     * @return Salas
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
     *
     * @return Salas
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
     * Set idEfector
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\Efectores $idEfector
     *
     * @return Salas
     */
    public function setIdEfector(\RI\DBHmi2GuaycuruCamasBundle\Entity\Efectores $idEfector = null)
    {
        $this->idEfector = $idEfector;

        return $this;
    }

    /**
     * Get idEfector
     *
     * @return \RI\DBHmi2GuaycuruCamasBundle\Entity\Efectores
     */
    public function getIdEfector()
    {
        return $this->idEfector;
    }

    /**
     * Set areaEfectorServicio
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresServicios $areaEfectorServicio
     *
     * @return Salas
     */
    public function setAreaEfectorServicio(\RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresServicios $areaEfectorServicio = null)
    {
        $this->areaEfectorServicio = $areaEfectorServicio;

        return $this;
    }

    /**
     * Get areaEfectorServicio
     *
     * @return \RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresServicios
     */
    public function getAreaEfectorServicio()
    {
        return $this->areaEfectorServicio;
    }
    
    public function __toString()
    {
      return $this->nombre;
      
    }
}
