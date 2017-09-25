<?php
/**
 * Proyecto Final Ingeniería Informática 2017 - UNL - Santa Fe - Argentina
 * 
 * Web Services Plataforma Web para centralización de camas críticas de internación en hospitales de la Provincia de Santa Fe
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 * 
 * @version 0.1.0
 */
namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * **Tabla: EfectoresServicios**
 * 
 * @api *Librería de acceso a la base de datos centralizada del sistema de camas críticas de internación*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *  
 * @link http://www.doctrine-project.org
 * Doctrine Project
 * 
 * @link https://symfony.com/doc/current/doctrine.html
 * Symfony - Databases and the Doctrine ORM
 *
 *
 * @ORM\Table(name="efectores_servicios", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_claveestd_cod_servicio_sector_subsector", columns={"claveestd", "cod_servicio", "sector", "subsector"}), @ORM\UniqueConstraint(name="idx_unique_id_efector_id_servicio_estadistica", columns={"id_efector", "id_servicio_estadistica"})}, indexes={@ORM\Index(name="idx_fk_efectores_servicios_id_efector", columns={"id_efector"}), @ORM\Index(name="idx_fk_efectores_servicios_id_servicio_estadistica", columns={"id_servicio_estadistica"})})
 * @ORM\Entity(repositoryClass="RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresServiciosRepository")
 */
class EfectoresServicios
{
    /**
     * @var integer Clave primaria
     *
     * @ORM\Column(name="id_efector_servicio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEfectorServicio;

    /**
     * @var string Clave de establecimiento definida por la Dirección Gral. de Estadística
     *
     * @ORM\Column(name="claveestd", type="string", length=8, nullable=false)
     */
    private $claveestd;

    /**
     * @var string Código nuclear de servicios de nación vigente desde 2008
     *
     * @ORM\Column(name="cod_servicio", type="string", length=3, nullable=false)
     */
    private $codServicio;

    /**
     * @var string 1=varones; 2=mujeres; 3=mixto; >3 especificación
     *
     * @ORM\Column(name="sector", type="string", length=1, nullable=false)
     */
    private $sector;

    /**
     * @var string 4=internación; 5=CE; 6=atención domiciliaria
     *
     * @ORM\Column(name="subsector", type="string", length=1, nullable=false)
     */
    private $subsector;

    /**
     * @var string Nombre del servicio de estadística
     *
     * @ORM\Column(name="nom_servicio_estadistica", type="string", length=255, nullable=false)
     */
    private $nomServicioEstadistica;

    /**
     * @var boolean Bandera de registro activo o no activo
     *
     * @ORM\Column(name="baja", type="boolean", nullable=false)
     */
    private $baja;

    /**
     * @var \DateTime Fecha de última modificación del registro
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion = 'CURRENT_TIMESTAMP';

    /**
     * @var \Efectores Efector donde se ha habilitado el servicio de 5 dígitos
     *
     * @ORM\ManyToOne(targetEntity="Efectores")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_efector", referencedColumnName="id_efector")
     * })
     */
    private $idEfector;

    /**
     * @var \ServiciosEstadistica Servicio de 5 dígitos de estadística Santa Fe
     *
     * @ORM\ManyToOne(targetEntity="ServiciosEstadistica")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio_estadistica", referencedColumnName="id_servicio_estadistica")
     * })
     */
    private $idServicioEstadistica;



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
     * Set claveestd
     *
     * @param string $claveestd
     *
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
     *
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
     *
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
     *
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
     *
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
     * Set baja
     *
     * @param boolean $baja
     *
     * @return EfectoresServicios
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
     * Set idEfector
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\Efectores $idEfector
     *
     * @return EfectoresServicios
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
     * Set idServicioEstadistica
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\ServiciosEstadistica $idServicioEstadistica
     *
     * @return EfectoresServicios
     */
    public function setIdServicioEstadistica(\RI\DBHmi2GuaycuruCamasBundle\Entity\ServiciosEstadistica $idServicioEstadistica = null)
    {
        $this->idServicioEstadistica = $idServicioEstadistica;

        return $this;
    }

    /**
     * Get idServicioEstadistica
     *
     * @return \RI\DBHmi2GuaycuruCamasBundle\Entity\ServiciosEstadistica
     */
    public function getIdServicioEstadistica()
    {
        return $this->idServicioEstadistica;
    }
}
