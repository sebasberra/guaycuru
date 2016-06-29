<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Localidades
 *
 * @ORM\Table(name="localidades", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_loc_cod_dpto_cod_prov_cod_pais", columns={"cod_loc", "cod_dpto", "cod_prov", "cod_pais"})}, indexes={@ORM\Index(name="localidades_fk_id_dpto", columns={"id_dpto"}), @ORM\Index(name="idx_nom_loc", columns={"nom_loc"})})
 * @ORM\Entity
 */
class Localidades
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_loc", type="string", length=50, nullable=false)
     */
    private $nomLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_loc", type="string", length=2, nullable=false)
     */
    private $codLoc;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_dpto", type="string", length=3, nullable=false)
     */
    private $codDpto;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_prov", type="string", length=2, nullable=false)
     */
    private $codProv;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_pais", type="string", length=3, nullable=false)
     */
    private $codPais;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_postal", type="string", length=4, nullable=true)
     */
    private $codPostal;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_localidad", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLocalidad;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Departamentos
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Departamentos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_dpto", referencedColumnName="id_dpto")
     * })
     */
    private $idDpto;



    /**
     * Set nomLoc
     *
     * @param string $nomLoc
     * @return Localidades
     */
    public function setNomLoc($nomLoc)
    {
        $this->nomLoc = $nomLoc;

        return $this;
    }

    /**
     * Get nomLoc
     *
     * @return string 
     */
    public function getNomLoc()
    {
        return $this->nomLoc;
    }

    /**
     * Set codLoc
     *
     * @param string $codLoc
     * @return Localidades
     */
    public function setCodLoc($codLoc)
    {
        $this->codLoc = $codLoc;

        return $this;
    }

    /**
     * Get codLoc
     *
     * @return string 
     */
    public function getCodLoc()
    {
        return $this->codLoc;
    }

    /**
     * Set codDpto
     *
     * @param string $codDpto
     * @return Localidades
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
     * Set codProv
     *
     * @param string $codProv
     * @return Localidades
     */
    public function setCodProv($codProv)
    {
        $this->codProv = $codProv;

        return $this;
    }

    /**
     * Get codProv
     *
     * @return string 
     */
    public function getCodProv()
    {
        return $this->codProv;
    }

    /**
     * Set codPais
     *
     * @param string $codPais
     * @return Localidades
     */
    public function setCodPais($codPais)
    {
        $this->codPais = $codPais;

        return $this;
    }

    /**
     * Get codPais
     *
     * @return string 
     */
    public function getCodPais()
    {
        return $this->codPais;
    }

    /**
     * Set codPostal
     *
     * @param string $codPostal
     * @return Localidades
     */
    public function setCodPostal($codPostal)
    {
        $this->codPostal = $codPostal;

        return $this;
    }

    /**
     * Get codPostal
     *
     * @return string 
     */
    public function getCodPostal()
    {
        return $this->codPostal;
    }

    /**
     * Get idLocalidad
     *
     * @return integer 
     */
    public function getIdLocalidad()
    {
        return $this->idLocalidad;
    }

    /**
     * Set idDpto
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Departamentos $idDpto
     * @return Localidades
     */
    public function setIdDpto(\Guaycuru\DBHmi2Bundle\Entity\Departamentos $idDpto = null)
    {
        $this->idDpto = $idDpto;

        return $this;
    }

    /**
     * Get idDpto
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Departamentos 
     */
    public function getIdDpto()
    {
        return $this->idDpto;
    }
}
