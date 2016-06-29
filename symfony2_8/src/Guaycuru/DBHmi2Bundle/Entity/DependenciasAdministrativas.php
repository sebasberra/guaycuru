<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DependenciasAdministrativas
 *
 * @ORM\Table(name="dependencias_administrativas", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_cod_dep_adm", columns={"cod_dep_adm"})})
 * @ORM\Entity
 */
class DependenciasAdministrativas
{
    /**
     * @var string
     *
     * @ORM\Column(name="cod_dep_adm", type="string", length=1, nullable=false)
     */
    private $codDepAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_dep_adm", type="string", length=50, nullable=false)
     */
    private $nomDepAdm;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_dep_adm", type="string", length=1, nullable=false)
     */
    private $tipoDepAdm;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_dependencia_adm", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idDependenciaAdm;



    /**
     * Set codDepAdm
     *
     * @param string $codDepAdm
     * @return DependenciasAdministrativas
     */
    public function setCodDepAdm($codDepAdm)
    {
        $this->codDepAdm = $codDepAdm;

        return $this;
    }

    /**
     * Get codDepAdm
     *
     * @return string 
     */
    public function getCodDepAdm()
    {
        return $this->codDepAdm;
    }

    /**
     * Set nomDepAdm
     *
     * @param string $nomDepAdm
     * @return DependenciasAdministrativas
     */
    public function setNomDepAdm($nomDepAdm)
    {
        $this->nomDepAdm = $nomDepAdm;

        return $this;
    }

    /**
     * Get nomDepAdm
     *
     * @return string 
     */
    public function getNomDepAdm()
    {
        return $this->nomDepAdm;
    }

    /**
     * Set tipoDepAdm
     *
     * @param string $tipoDepAdm
     * @return DependenciasAdministrativas
     */
    public function setTipoDepAdm($tipoDepAdm)
    {
        $this->tipoDepAdm = $tipoDepAdm;

        return $this;
    }

    /**
     * Get tipoDepAdm
     *
     * @return string 
     */
    public function getTipoDepAdm()
    {
        return $this->tipoDepAdm;
    }

    /**
     * Get idDependenciaAdm
     *
     * @return integer 
     */
    public function getIdDependenciaAdm()
    {
        return $this->idDependenciaAdm;
    }
}
