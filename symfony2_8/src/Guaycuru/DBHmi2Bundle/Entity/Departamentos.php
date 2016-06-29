<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamentos
 *
 * @ORM\Table(name="departamentos", indexes={@ORM\Index(name="departamentos_fk_id_prov", columns={"id_prov"}), @ORM\Index(name="idx_nom_dpto", columns={"nom_dpto"})})
 * @ORM\Entity
 */
class Departamentos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_dpto", type="string", length=50, nullable=false)
     */
    private $nomDpto;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_dpto", type="string", length=3, nullable=false)
     */
    private $codDpto;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_dpto", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDpto;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Provincias
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Provincias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_prov", referencedColumnName="id_prov")
     * })
     */
    private $idProv;



    /**
     * Set nomDpto
     *
     * @param string $nomDpto
     * @return Departamentos
     */
    public function setNomDpto($nomDpto)
    {
        $this->nomDpto = $nomDpto;

        return $this;
    }

    /**
     * Get nomDpto
     *
     * @return string 
     */
    public function getNomDpto()
    {
        return $this->nomDpto;
    }

    /**
     * Set codDpto
     *
     * @param string $codDpto
     * @return Departamentos
     */
    public function setCodDpto($codDpto)
    {
        $this->codDpto = $codDpto;

        return $this;
    }

    /**
     * Get codDpto
     *
     * @return string 
     */
    public function getCodDpto()
    {
        return $this->codDpto;
    }

    /**
     * Get idDpto
     *
     * @return integer 
     */
    public function getIdDpto()
    {
        return $this->idDpto;
    }

    /**
     * Set idProv
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Provincias $idProv
     * @return Departamentos
     */
    public function setIdProv(\Guaycuru\DBHmi2Bundle\Entity\Provincias $idProv = null)
    {
        $this->idProv = $idProv;

        return $this;
    }

    /**
     * Get idProv
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Provincias 
     */
    public function getIdProv()
    {
        return $this->idProv;
    }
}
