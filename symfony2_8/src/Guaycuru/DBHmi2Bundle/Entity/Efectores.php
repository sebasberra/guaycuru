<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Efectores
 *
 * @ORM\Table(name="efectores", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_claveestd", columns={"claveestd"})}, indexes={@ORM\Index(name="fk_id_localidad", columns={"id_localidad"}), @ORM\Index(name="fk_id_dependencia_adm", columns={"id_dependencia_adm"}), @ORM\Index(name="fk_id_regimen_juridico", columns={"id_regimen_juridico"}), @ORM\Index(name="fk_id_nodo", columns={"id_nodo"}), @ORM\Index(name="fk_id_subnodo", columns={"id_subnodo"}), @ORM\Index(name="fk_id_nivel_complejidad", columns={"id_nivel_complejidad"})})
 * @ORM\Entity
 */
class Efectores
{
    /**
     * @var string
     *
     * @ORM\Column(name="claveestd", type="string", length=8, nullable=false)
     */
    private $claveestd;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_efector", type="string", length=1, nullable=true)
     */
    private $tipoEfector;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_efector", type="string", length=255, nullable=false)
     */
    private $nomEfector;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_red_efector", type="string", length=50, nullable=false)
     */
    private $nomRedEfector;

    /**
     * @var boolean
     *
     * @ORM\Column(name="nodo", type="boolean", nullable=false)
     */
    private $nodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="subnodo", type="smallint", nullable=false)
     */
    private $subnodo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="internacion", type="boolean", nullable=false)
     */
    private $internacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="baja", type="boolean", nullable=false)
     */
    private $baja;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_efector", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEfector;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Subnodos
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Subnodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_subnodo", referencedColumnName="id_subnodo")
     * })
     */
    private $idSubnodo;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\NivelesComplejidades
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\NivelesComplejidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nivel_complejidad", referencedColumnName="id_nivel_complejidad")
     * })
     */
    private $idNivelComplejidad;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Nodos
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Nodos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_nodo", referencedColumnName="id_nodo")
     * })
     */
    private $idNodo;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\RegimenesJuridicos
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\RegimenesJuridicos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_regimen_juridico", referencedColumnName="id_regimen_juridico")
     * })
     */
    private $idRegimenJuridico;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\DependenciasAdministrativas
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\DependenciasAdministrativas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_dependencia_adm", referencedColumnName="id_dependencia_adm")
     * })
     */
    private $idDependenciaAdm;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\Localidades
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\Localidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_localidad", referencedColumnName="id_localidad")
     * })
     */
    private $idLocalidad;



    /**
     * Set claveestd
     *
     * @param string $claveestd
     * @return Efectores
     */
    public function setClaveestd($claveestd)
    {
        $this->claveestd = $claveestd;

        return $this;
    }

    /**
     * Get claveestd
     *
     * @return string 
     */
    public function getClaveestd()
    {
        return $this->claveestd;
    }

    /**
     * Set tipoEfector
     *
     * @param string $tipoEfector
     * @return Efectores
     */
    public function setTipoEfector($tipoEfector)
    {
        $this->tipoEfector = $tipoEfector;

        return $this;
    }

    /**
     * Get tipoEfector
     *
     * @return string 
     */
    public function getTipoEfector()
    {
        return $this->tipoEfector;
    }

    /**
     * Set nomEfector
     *
     * @param string $nomEfector
     * @return Efectores
     */
    public function setNomEfector($nomEfector)
    {
        $this->nomEfector = $nomEfector;

        return $this;
    }

    /**
     * Get nomEfector
     *
     * @return string 
     */
    public function getNomEfector()
    {
        return $this->nomEfector;
    }

    /**
     * Set nomRedEfector
     *
     * @param string $nomRedEfector
     * @return Efectores
     */
    public function setNomRedEfector($nomRedEfector)
    {
        $this->nomRedEfector = $nomRedEfector;

        return $this;
    }

    /**
     * Get nomRedEfector
     *
     * @return string 
     */
    public function getNomRedEfector()
    {
        return $this->nomRedEfector;
    }

    /**
     * Set nodo
     *
     * @param boolean $nodo
     * @return Efectores
     */
    public function setNodo($nodo)
    {
        $this->nodo = $nodo;

        return $this;
    }

    /**
     * Get nodo
     *
     * @return boolean 
     */
    public function getNodo()
    {
        return $this->nodo;
    }

    /**
     * Set subnodo
     *
     * @param integer $subnodo
     * @return Efectores
     */
    public function setSubnodo($subnodo)
    {
        $this->subnodo = $subnodo;

        return $this;
    }

    /**
     * Get subnodo
     *
     * @return integer 
     */
    public function getSubnodo()
    {
        return $this->subnodo;
    }

    /**
     * Set internacion
     *
     * @param boolean $internacion
     * @return Efectores
     */
    public function setInternacion($internacion)
    {
        $this->internacion = $internacion;

        return $this;
    }

    /**
     * Get internacion
     *
     * @return boolean 
     */
    public function getInternacion()
    {
        return $this->internacion;
    }

    /**
     * Set baja
     *
     * @param boolean $baja
     * @return Efectores
     */
    public function setBaja($baja)
    {
        $this->baja = $baja;

        return $this;
    }

    /**
     * Get baja
     *
     * @return boolean 
     */
    public function getBaja()
    {
        return $this->baja;
    }

    /**
     * Get idEfector
     *
     * @return integer 
     */
    public function getIdEfector()
    {
        return $this->idEfector;
    }

    /**
     * Set idSubnodo
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Subnodos $idSubnodo
     * @return Efectores
     */
    public function setIdSubnodo(\Guaycuru\DBHmi2Bundle\Entity\Subnodos $idSubnodo = null)
    {
        $this->idSubnodo = $idSubnodo;

        return $this;
    }

    /**
     * Get idSubnodo
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Subnodos 
     */
    public function getIdSubnodo()
    {
        return $this->idSubnodo;
    }

    /**
     * Set idNivelComplejidad
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\NivelesComplejidades $idNivelComplejidad
     * @return Efectores
     */
    public function setIdNivelComplejidad(\Guaycuru\DBHmi2Bundle\Entity\NivelesComplejidades $idNivelComplejidad = null)
    {
        $this->idNivelComplejidad = $idNivelComplejidad;

        return $this;
    }

    /**
     * Get idNivelComplejidad
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\NivelesComplejidades 
     */
    public function getIdNivelComplejidad()
    {
        return $this->idNivelComplejidad;
    }

    /**
     * Set idNodo
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Nodos $idNodo
     * @return Efectores
     */
    public function setIdNodo(\Guaycuru\DBHmi2Bundle\Entity\Nodos $idNodo = null)
    {
        $this->idNodo = $idNodo;

        return $this;
    }

    /**
     * Get idNodo
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Nodos 
     */
    public function getIdNodo()
    {
        return $this->idNodo;
    }

    /**
     * Set idRegimenJuridico
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\RegimenesJuridicos $idRegimenJuridico
     * @return Efectores
     */
    public function setIdRegimenJuridico(\Guaycuru\DBHmi2Bundle\Entity\RegimenesJuridicos $idRegimenJuridico = null)
    {
        $this->idRegimenJuridico = $idRegimenJuridico;

        return $this;
    }

    /**
     * Get idRegimenJuridico
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\RegimenesJuridicos 
     */
    public function getIdRegimenJuridico()
    {
        return $this->idRegimenJuridico;
    }

    /**
     * Set idDependenciaAdm
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\DependenciasAdministrativas $idDependenciaAdm
     * @return Efectores
     */
    public function setIdDependenciaAdm(\Guaycuru\DBHmi2Bundle\Entity\DependenciasAdministrativas $idDependenciaAdm = null)
    {
        $this->idDependenciaAdm = $idDependenciaAdm;

        return $this;
    }

    /**
     * Get idDependenciaAdm
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\DependenciasAdministrativas 
     */
    public function getIdDependenciaAdm()
    {
        return $this->idDependenciaAdm;
    }

    /**
     * Set idLocalidad
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\Localidades $idLocalidad
     * @return Efectores
     */
    public function setIdLocalidad(\Guaycuru\DBHmi2Bundle\Entity\Localidades $idLocalidad = null)
    {
        $this->idLocalidad = $idLocalidad;

        return $this;
    }

    /**
     * Get idLocalidad
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\Localidades 
     */
    public function getIdLocalidad()
    {
        return $this->idLocalidad;
    }
}
