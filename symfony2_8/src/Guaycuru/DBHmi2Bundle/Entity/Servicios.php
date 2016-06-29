<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Servicios
 *
 * @ORM\Table(name="servicios", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_servicio", columns={"cod_servicio"})})
 * @ORM\Entity
 */
class Servicios
{
    /**
     * @var string
     *
     * @ORM\Column(name="cod_servicio", type="string", length=3, nullable=false)
     */
    private $codServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_servicio", type="string", length=255, nullable=false)
     */
    private $nomServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_red_servicio", type="string", length=30, nullable=false)
     */
    private $nomRedServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_servicio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idServicio;



    /**
     * Set codServicio
     *
     * @param string $codServicio
     * @return Servicios
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
     * Set nomServicio
     *
     * @param string $nomServicio
     * @return Servicios
     */
    public function setNomServicio($nomServicio)
    {
        $this->nomServicio = $nomServicio;

        return $this;
    }

    /**
     * Get nomServicio
     *
     * @return string 
     */
    public function getNomServicio()
    {
        return $this->nomServicio;
    }

    /**
     * Set nomRedServicio
     *
     * @param string $nomRedServicio
     * @return Servicios
     */
    public function setNomRedServicio($nomRedServicio)
    {
        $this->nomRedServicio = $nomRedServicio;

        return $this;
    }

    /**
     * Get nomRedServicio
     *
     * @return string 
     */
    public function getNomRedServicio()
    {
        return $this->nomRedServicio;
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
}
