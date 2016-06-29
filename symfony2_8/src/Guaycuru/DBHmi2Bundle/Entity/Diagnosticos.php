<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Diagnosticos
 *
 * @ORM\Table(name="diagnosticos", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_internacion_id_ciex_4", columns={"id_internacion", "id_ciex_4"}), @ORM\UniqueConstraint(name="idx_unique_id_internacion_cod_3dig_cod_4dig", columns={"id_internacion", "cod_3dig", "cod_4dig"})}, indexes={@ORM\Index(name="fk_id_ciex_4", columns={"id_ciex_4"}), @ORM\Index(name="idx_cod_3dig", columns={"cod_3dig"}), @ORM\Index(name="IDX_6392977D69C7BEC3", columns={"id_internacion"})})
 * @ORM\Entity
 */
class Diagnosticos
{
    /**
     * @var string
     *
     * @ORM\Column(name="cod_3dig", type="string", length=3, nullable=false)
     */
    private $cod3dig;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_4dig", type="string", length=1, nullable=false)
     */
    private $cod4dig;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nro_orden", type="boolean", nullable=false)
     */
    private $nroOrden;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_diagnostico", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDiagnostico;

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
     * @var \Guaycuru\DBHmi2Bundle\Entity\Ciex4
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Ciex4")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_4", referencedColumnName="id_ciex_4")
     * })
     */
    private $idCiex4;



    /**
     * Set cod3dig
     *
     * @param string $cod3dig
     * @return Diagnosticos
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
     * @return Diagnosticos
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
     * Set nroOrden
     *
     * @param boolean $nroOrden
     * @return Diagnosticos
     */
    public function setNroOrden($nroOrden)
    {
        $this->nroOrden = $nroOrden;

        return $this;
    }

    /**
     * Get nroOrden
     *
     * @return boolean 
     */
    public function getNroOrden()
    {
        return $this->nroOrden;
    }

    /**
     * Get idDiagnostico
     *
     * @return integer 
     */
    public function getIdDiagnostico()
    {
        return $this->idDiagnostico;
    }

    /**
     * Set idInternacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Internaciones $idInternacion
     * @return Diagnosticos
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

    /**
     * Set idCiex4
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Ciex4 $idCiex4
     * @return Diagnosticos
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
}
