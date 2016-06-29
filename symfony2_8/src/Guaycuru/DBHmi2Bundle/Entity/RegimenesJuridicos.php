<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RegimenesJuridicos
 *
 * @ORM\Table(name="regimenes_juridicos", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_codigo", columns={"codigo"})})
 * @ORM\Entity
 */
class RegimenesJuridicos
{
    /**
     * @var string
     *
     * @ORM\Column(name="regjurest", type="string", length=15, nullable=false)
     */
    private $regjurest;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=2, nullable=false)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_regimen_juridico", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idRegimenJuridico;



    /**
     * Set regjurest
     *
     * @param string $regjurest
     * @return RegimenesJuridicos
     */
    public function setRegjurest($regjurest)
    {
        $this->regjurest = $regjurest;

        return $this;
    }

    /**
     * Get regjurest
     *
     * @return string 
     */
    public function getRegjurest()
    {
        return $this->regjurest;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return RegimenesJuridicos
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Get idRegimenJuridico
     *
     * @return integer 
     */
    public function getIdRegimenJuridico()
    {
        return $this->idRegimenJuridico;
    }
}
