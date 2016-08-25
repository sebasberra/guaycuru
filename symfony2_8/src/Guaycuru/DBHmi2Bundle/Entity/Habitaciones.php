<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Habitaciones
 *
 * @ORM\Table(name="habitaciones", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_nombre_id_sala", columns={"nombre", "id_sala"})}, indexes={@ORM\Index(name="idx_fk_habitaciones_id_sala", columns={"id_sala"})})
 * @ORM\Entity
 */
class Habitaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_habitacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idHabitacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexo", type="boolean", nullable=false)
     */
    private $sexo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="edad_desde", type="boolean", nullable=false)
     */
    private $edadDesde;

    /**
     * @var boolean
     *
     * @ORM\Column(name="edad_hasta", type="boolean", nullable=false)
     */
    private $edadHasta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_edad", type="string", length=1, nullable=false)
     */
    private $tipoEdad;

    /**
     * @var integer
     *
     * @ORM\Column(name="cant_camas", type="smallint", nullable=false)
     */
    private $cantCamas;

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
     * @var \Salas
     *
     * @ORM\ManyToOne(targetEntity="Salas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_sala", referencedColumnName="id_sala")
     * })
     */
    private $idSala;



    /**
     * Get idHabitacion
     *
     * @return integer 
     */
    public function getIdHabitacion()
    {
        return $this->idHabitacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Habitaciones
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
     * Set sexo
     *
     * @param boolean $sexo
     * @return Habitaciones
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return boolean 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set edadDesde
     *
     * @param boolean $edadDesde
     * @return Habitaciones
     */
    public function setEdadDesde($edadDesde)
    {
        $this->edadDesde = $edadDesde;

        return $this;
    }

    /**
     * Get edadDesde
     *
     * @return boolean 
     */
    public function getEdadDesde()
    {
        return $this->edadDesde;
    }

    /**
     * Set edadHasta
     *
     * @param boolean $edadHasta
     * @return Habitaciones
     */
    public function setEdadHasta($edadHasta)
    {
        $this->edadHasta = $edadHasta;

        return $this;
    }

    /**
     * Get edadHasta
     *
     * @return boolean 
     */
    public function getEdadHasta()
    {
        return $this->edadHasta;
    }

    /**
     * Set tipoEdad
     *
     * @param string $tipoEdad
     * @return Habitaciones
     */
    public function setTipoEdad($tipoEdad)
    {
        $this->tipoEdad = $tipoEdad;

        return $this;
    }

    /**
     * Get tipoEdad
     *
     * @return string 
     */
    public function getTipoEdad()
    {
        return $this->tipoEdad;
    }

    /**
     * Set cantCamas
     *
     * @param integer $cantCamas
     * @return Habitaciones
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
     * Set baja
     *
     * @param boolean $baja
     * @return Habitaciones
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
     * @return Habitaciones
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
     * Set idSala
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Salas $idSala
     * @return Habitaciones
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
