<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paises
 *
 * @ORM\Table(name="paises", indexes={@ORM\Index(name="idx_nom_pais", columns={"nom_pais"})})
 * @ORM\Entity
 */
class Paises
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_pais", type="string", length=50, nullable=false)
     */
    private $nomPais;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_pais", type="string", length=3, nullable=false)
     */
    private $codPais;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_pais", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idPais;



    /**
     * Set nomPais
     *
     * @param string $nomPais
     * @return Paises
     */
    public function setNomPais($nomPais)
    {
        $this->nomPais = $nomPais;

        return $this;
    }

    /**
     * Get nomPais
     *
     * @return string 
     */
    public function getNomPais()
    {
        return $this->nomPais;
    }

    /**
     * Set codPais
     *
     * @param string $codPais
     * @return Paises
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
     * Get idPais
     *
     * @return integer 
     */
    public function getIdPais()
    {
        return $this->idPais;
    }
}