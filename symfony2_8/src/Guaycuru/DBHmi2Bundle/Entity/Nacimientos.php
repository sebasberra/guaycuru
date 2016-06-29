<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nacimientos
 *
 * @ORM\Table(name="nacimientos", indexes={@ORM\Index(name="fk_id_internacion", columns={"id_internacion"})})
 * @ORM\Entity
 */
class Nacimientos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="peso", type="smallint", nullable=false)
     */
    private $peso;

    /**
     * @var boolean
     *
     * @ORM\Column(name="condicion_al_nacer", type="boolean", nullable=false)
     */
    private $condicionAlNacer;

    /**
     * @var boolean
     *
     * @ORM\Column(name="terminacion", type="boolean", nullable=true)
     */
    private $terminacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sexo", type="boolean", nullable=false)
     */
    private $sexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nacimiento", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNacimiento;

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
     * Set peso
     *
     * @param integer $peso
     * @return Nacimientos
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return integer 
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set condicionAlNacer
     *
     * @param boolean $condicionAlNacer
     * @return Nacimientos
     */
    public function setCondicionAlNacer($condicionAlNacer)
    {
        $this->condicionAlNacer = $condicionAlNacer;

        return $this;
    }

    /**
     * Get condicionAlNacer
     *
     * @return boolean 
     */
    public function getCondicionAlNacer()
    {
        return $this->condicionAlNacer;
    }

    /**
     * Set terminacion
     *
     * @param boolean $terminacion
     * @return Nacimientos
     */
    public function setTerminacion($terminacion)
    {
        $this->terminacion = $terminacion;

        return $this;
    }

    /**
     * Get terminacion
     *
     * @return boolean 
     */
    public function getTerminacion()
    {
        return $this->terminacion;
    }

    /**
     * Set sexo
     *
     * @param boolean $sexo
     * @return Nacimientos
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
     * Get idNacimiento
     *
     * @return integer 
     */
    public function getIdNacimiento()
    {
        return $this->idNacimiento;
    }

    /**
     * Set idInternacion
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Internaciones $idInternacion
     * @return Nacimientos
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
}
