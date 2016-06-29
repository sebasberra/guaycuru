<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Salas
 *
 * @ORM\Table(name="salas", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_efector_nombre", columns={"id_efector", "nombre"})}, indexes={@ORM\Index(name="IDX_FEDB5403305FE2F", columns={"id_efector"})})
 * @ORM\Entity
 */
class Salas
{
    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_camas", type="smallint", nullable=false)
     */
    private $cantCamas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="mover_camas", type="boolean", nullable=false)
     */
    private $moverCamas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_modificacion", type="datetime", nullable=false)
     */
    private $fechaModificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_sala", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSala;

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
     * Set nombre
     *
     * @param string $nombre
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
     * Set fechaModificacion
     *
     * @param \DateTime $fechaModificacion
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
     * Get idSala
     *
     * @return integer 
     */
    public function getIdSala()
    {
        return $this->idSala;
    }

    /**
     * Set idEfector
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Efectores $idEfector
     * @return Salas
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
