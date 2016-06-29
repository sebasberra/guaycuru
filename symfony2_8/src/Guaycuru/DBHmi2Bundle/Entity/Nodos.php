<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nodos
 *
 * @ORM\Table(name="nodos", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_numregion", columns={"numregion"})})
 * @ORM\Entity
 */
class Nodos
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom_nodo", type="string", length=255, nullable=false)
     */
    private $nomNodo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="numregion", type="boolean", nullable=false)
     */
    private $numregion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nodo", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNodo;



    /**
     * Set nomNodo
     *
     * @param string $nomNodo
     * @return Nodos
     */
    public function setNomNodo($nomNodo)
    {
        $this->nomNodo = $nomNodo;

        return $this;
    }

    /**
     * Get nomNodo
     *
     * @return string 
     */
    public function getNomNodo()
    {
        return $this->nomNodo;
    }

    /**
     * Set numregion
     *
     * @param boolean $numregion
     * @return Nodos
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
     * Get idNodo
     *
     * @return integer 
     */
    public function getIdNodo()
    {
        return $this->idNodo;
    }
}
