<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServiciosSalas
 *
 * @ORM\Table(name="servicios_salas", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_efector_servicio_id_sala", columns={"id_efector_servicio", "id_sala"})}, indexes={@ORM\Index(name="fk_id_sala", columns={"id_sala"}), @ORM\Index(name="IDX_D8861F428239A6E4", columns={"id_efector_servicio"})})
 * @ORM\Entity
 */
class ServiciosSalas
{
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
     * @ORM\Column(name="id_servicio_sala", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idServicioSala;

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
     * Set baja
     *
     * @param boolean $baja
     * @return ServiciosSalas
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
     * @return ServiciosSalas
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
     * Get idServicioSala
     *
     * @return integer 
     */
    public function getIdServicioSala()
    {
        return $this->idServicioSala;
    }

    /**
     * Set idEfectorServicio
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\EfectoresServicios $idEfectorServicio
     * @return ServiciosSalas
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
     * @return ServiciosSalas
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
