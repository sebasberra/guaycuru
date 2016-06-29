<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provincias
 *
 * @ORM\Table(name="provincias", indexes={@ORM\Index(name="provincias_fk_id_pais", columns={"id_pais"}), @ORM\Index(name="idx_nom_prov", columns={"nom_prov"})})
 * @ORM\Entity
 */
class Provincias
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_prov", type="string", length=50, nullable=false)
     */
    private $nomProv;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_prov", type="string", length=2, nullable=false)
     */
    private $codProv;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_prov", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProv;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Paises
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Paises")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pais", referencedColumnName="id_pais")
     * })
     */
    private $idPais;



    /**
     * Set nomProv
     *
     * @param string $nomProv
     * @return Provincias
     */
    public function setNomProv($nomProv)
    {
        $this->nomProv = $nomProv;

        return $this;
    }

    /**
     * Get nomProv
     *
     * @return string 
     */
    public function getNomProv()
    {
        return $this->nomProv;
    }

    /**
     * Set codProv
     *
     * @param string $codProv
     * @return Provincias
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
     * Get idProv
     *
     * @return integer 
     */
    public function getIdProv()
    {
        return $this->idProv;
    }

    /**
     * Set idPais
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Paises $idPais
     * @return Provincias
     */
    public function setIdPais(\Guaycuru\DBHmi2Bundle\Entity\Paises $idPais = null)
    {
        $this->idPais = $idPais;

        return $this;
    }

    /**
     * Get idPais
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Paises 
     */
    public function getIdPais()
    {
        return $this->idPais;
    }
}
