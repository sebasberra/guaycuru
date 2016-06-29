<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Subnodos
 *
 * @ORM\Table(name="subnodos", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_numregion_numsubregion", columns={"numregion", "numsubregion"})})
 * @ORM\Entity
 */
class Subnodos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_nodo", type="integer", nullable=false)
     */
    private $idNodo;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_subnodo", type="string", length=255, nullable=false)
     */
    private $nomSubnodo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="numregion", type="boolean", nullable=false)
     */
    private $numregion;

    /**
     * @var integer
     *
     * @ORM\Column(name="numsubregion", type="smallint", nullable=false)
     */
    private $numsubregion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_subnodo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idSubnodo;



    /**
     * Set idNodo
     *
     * @param integer $idNodo
     * @return Subnodos
     */
    public function setIdNodo($idNodo)
    {
        $this->idNodo = $idNodo;

        return $this;
    }

    /**
     * Get idNodo
     *
     * @return integer 
     */
    public function getIdNodo()
    {
        return $this->idNodo;
    }

    /**
     * Set nomSubnodo
     *
     * @param string $nomSubnodo
     * @return Subnodos
     */
    public function setNomSubnodo($nomSubnodo)
    {
        $this->nomSubnodo = $nomSubnodo;

        return $this;
    }

    /**
     * Get nomSubnodo
     *
     * @return string 
     */
    public function getNomSubnodo()
    {
        return $this->nomSubnodo;
    }

    /**
     * Set numregion
     *
     * @param boolean $numregion
     * @return Subnodos
     */
    public function setNumregion($numregion)
    {
        $this->numregion = $numregion;

        return $this;
    }

    /**
     * Get numregion
     *
     * @return boolean 
     */
    public function getNumregion()
    {
        return $this->numregion;
    }

    /**
     * Set numsubregion
     *
     * @param integer $numsubregion
     * @return Subnodos
     */
    public function setNumsubregion($numsubregion)
    {
        $this->numsubregion = $numsubregion;

        return $this;
    }

    /**
     * Get numsubregion
     *
     * @return integer 
     */
    public function getNumsubregion()
    {
        return $this->numsubregion;
    }

    /**
     * Get idSubnodo
     *
     * @return integer 
     */
    public function getIdSubnodo()
    {
        return $this->idSubnodo;
    }
}
