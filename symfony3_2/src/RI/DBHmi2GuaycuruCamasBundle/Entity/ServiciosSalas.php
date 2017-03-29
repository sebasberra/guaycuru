<?php

namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ServiciosSalas
 *
 * @ORM\Table(name="servicios_salas", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_efector_servicio_id_sala", columns={"id_efector_servicio", "id_sala"}), @ORM\UniqueConstraint(name="idx_unique_id_efector_id_efector_servicio_id_sala", columns={"id_efector", "id_efector_servicio", "id_sala"})}, indexes={@ORM\Index(name="idx_fk_servicios_salas_id_sala", columns={"id_sala"}), @ORM\Index(name="fk_servicios_salas_id_efector_idx", columns={"id_efector"}), @ORM\Index(name="IDX_D8861F428239A6E4", columns={"id_efector_servicio"})})
 * @ORM\Entity(repositoryClass="RI\DBHmi2GuaycuruCamasBundle\Entity\ServiciosSalasRepository")
 */
class ServiciosSalas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_servicio_sala", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idServicioSala;

    /**
     * @var boolean
     *
     * @ORM\Column(name="agudo_cronico", type="boolean", nullable=false)
     */
    private $agudoCronico;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo_servicio_sala", type="boolean", nullable=false)
     */
    private $tipoServicioSala;

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
     *   @ORM\JoinColumn(name="id_efector_servicio", referencedColumnName="id_efector_servicio")
     * })
     */
    private $idEfectorServicio;

    /**
     * @var \Salas
     *
     * @ORM\ManyToOne(targetEntity="Salas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sala", referencedColumnName="id_sala")
     * })
     */
    private $idSala;



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
     * Set agudoCronico
     *
     * @param boolean $agudoCronico
     *
     * @return ServiciosSalas
     */
    public function setAgudoCronico($agudoCronico)
    {
        $this->agudoCronico = $agudoCronico;

        return $this;
    }

    /**
     * Get agudoCronico
     *
     * @return boolean
     */
    public function getAgudoCronico()
    {
        return $this->agudoCronico;
    }

    /**
     * Set tipoServicioSala
     *
     * @param boolean $tipoServicioSala
     *
     * @return ServiciosSalas
     */
    public function setTipoServicioSala($tipoServicioSala)
    {
        $this->tipoServicioSala = $tipoServicioSala;

        return $this;
    }

    /**
     * Get tipoServicioSala
     *
     * @return boolean
     */
    public function getTipoServicioSala()
    {
        return $this->tipoServicioSala;
    }

    /**
     * Set baja
     *
     * @param boolean $baja
     *
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
     *
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
     * Set idEfector
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\Efectores $idEfector
     *
     * @return ServiciosSalas
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
     * Set idEfectorServicio
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresServicios $idEfectorServicio
     *
     * @return ServiciosSalas
     */
    public function setIdEfectorServicio(\RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresServicios $idEfectorServicio = null)
    {
        $this->idEfectorServicio = $idEfectorServicio;

        return $this;
    }

    /**
     * Get idEfectorServicio
     *
     * @return \RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresServicios
     */
    public function getIdEfectorServicio()
    {
        return $this->idEfectorServicio;
    }

    /**
     * Set idSala
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\Salas $idSala
     *
     * @return ServiciosSalas
     */
    public function setIdSala(\RI\DBHmi2GuaycuruCamasBundle\Entity\Salas $idSala = null)
    {
        $this->idSala = $idSala;

        return $this;
    }

    /**
     * Get idSala
     *
     * @return \RI\DBHmi2GuaycuruCamasBundle\Entity\Salas
     */
    public function getIdSala()
    {
        return $this->idSala;
    }
    
    public function __toString()
    {
      return $this->idEfectorServicio->getNomServicioEstadistica();
      
    }
}
