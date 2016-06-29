<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperacionesOld
 *
 * @ORM\Table(name="operaciones_old", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_operacion", columns={"cod_operacion"})})
 * @ORM\Entity
 */
class OperacionesOld
{
    /**
     * @var string
     *
     * @ORM\Column(name="cod_operacion", type="string", length=4, nullable=false)
     */
    private $codOperacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_operacion", type="string", length=255, nullable=false)
     */
    private $nomOperacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_red_operacion", type="string", length=30, nullable=false)
     */
    private $nomRedOperacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_operacion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOperacion;



    /**
     * Set codOperacion
     *
     * @param string $codOperacion
     * @return OperacionesOld
     */
    public function setCodOperacion($codOperacion)
    {
        $this->codOperacion = $codOperacion;

        return $this;
    }

    /**
     * Get codOperacion
     *
     * @return string 
     */
    public function getCodOperacion()
    {
        return $this->codOperacion;
    }

    /**
     * Set nomOperacion
     *
     * @param string $nomOperacion
     * @return OperacionesOld
     */
    public function setNomOperacion($nomOperacion)
    {
        $this->nomOperacion = $nomOperacion;

        return $this;
    }

    /**
     * Get nomOperacion
     *
     * @return string 
     */
    public function getNomOperacion()
    {
        return $this->nomOperacion;
    }

    /**
     * Set nomRedOperacion
     *
     * @param string $nomRedOperacion
     * @return OperacionesOld
     */
    public function setNomRedOperacion($nomRedOperacion)
    {
        $this->nomRedOperacion = $nomRedOperacion;

        return $this;
    }

    /**
     * Get nomRedOperacion
     *
     * @return string 
     */
    public function getNomRedOperacion()
    {
        return $this->nomRedOperacion;
    }

    /**
     * Get idOperacion
     *
     * @return integer 
     */
    public function getIdOperacion()
    {
        return $this->idOperacion;
    }
}
