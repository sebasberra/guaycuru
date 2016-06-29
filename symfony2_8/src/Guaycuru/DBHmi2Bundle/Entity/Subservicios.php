<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subservicios
 *
 * @ORM\Table(name="subservicios", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_efector_servicio_id_servicio", columns={"id_efector_servicio", "id_servicio"})}, indexes={@ORM\Index(name="fk_id_servicio", columns={"id_servicio"}), @ORM\Index(name="idx_claveestd_cod_servicio", columns={"claveestd", "cod_servicio"}), @ORM\Index(name="IDX_54112B168239A6E4", columns={"id_efector_servicio"})})
 * @ORM\Entity
 */
class Subservicios
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_subservicio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSubservicio;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Servicios
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Servicios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_servicio", referencedColumnName="id_servicio")
     * })
     */
    private $idServicio;

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
     * Set claveestd
     *
     * @param string $claveestd
     * @return Subservicios
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
     * @return Subservicios
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
     * @return Subservicios
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
     * Get idSubservicio
     *
     * @return integer 
     */
    public function getIdSubservicio()
    {
        return $this->idSubservicio;
    }

    /**
     * Set idServicio
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Servicios $idServicio
     * @return Subservicios
     */
    public function setIdServicio(\Guaycuru\DBHmi2Bundle\Entity\Servicios $idServicio = null)
    {
        $this->idServicio = $idServicio;

        return $this;
    }

    /**
     * Get idServicio
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Servicios 
     */
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    /**
     * Set idEfectorServicio
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\EfectoresServicios $idEfectorServicio
     * @return Subservicios
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
}
