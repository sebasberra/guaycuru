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
 * **Tabla: ServiciosEstadistica**
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
 * @ORM\Table(
 *      name="servicios_estadistica", 
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="idx_unique_cod_servicio_sector_subsector", 
 *              columns={"cod_servicio", "sector", "subsector"})
 *      }, 
 *      indexes={
 *          @ORM\Index(
 *              name="idx_fk_servicios_estadistica_id_servicio", 
 *              columns={"id_servicio"})
 *      }
 *  )
 * 
 * @ORM\Entity
 */
class ServiciosEstadistica
{
    /**
     * @var integer Clave primaria
     *
     * @ORM\Column(name="id_servicio_estadistica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idServicioEstadistica;

    /**
     * @var integer No se utiliza en esta implementación
     *
     * @ORM\Column(name="id_servicio", type="integer", nullable=false)
     */
    private $idServicio;

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
     * @var string Descripción del servicio
     *
     * @ORM\Column(name="nom_servicio_estadistica", type="string", length=255, nullable=false)
     */
    private $nomServicioEstadistica;

    /**
     * @var string Descripción reducida del servicio
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
     *
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
     *
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
     *
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
     *
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
     *
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
     *
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
