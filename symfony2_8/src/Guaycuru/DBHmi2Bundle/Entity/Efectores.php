<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Efectores
 *
 * @ORM\Table(name="efectores", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_claveestd", columns={"claveestd"})}, indexes={@ORM\Index(name="idx_fk_efectores_id_localidad", columns={"id_localidad"}), @ORM\Index(name="idx_fk_efectores_id_dependencia_adm", columns={"id_dependencia_adm"}), @ORM\Index(name="idx_fk_efectores_id_regimen_juridico", columns={"id_regimen_juridico"}), @ORM\Index(name="idx_fk_efectores_id_nodo", columns={"id_nodo"}), @ORM\Index(name="idx_fk_efectores_id_subnodo", columns={"id_subnodo"}), @ORM\Index(name="idx_fk_efectores_id_nivel_complejidad", columns={"id_nivel_complejidad"}), @ORM\Index(name="idx_clavesisa", columns={"clavesisa"})})
 * @ORM\Entity
 */
class Efectores
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_efector", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEfector;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nodo", type="smallint", nullable=false)
     */
    private $idNodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_subnodo", type="smallint", nullable=false)
     */
    private $idSubnodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_dependencia_adm", type="integer", nullable=true)
     */
    private $idDependenciaAdm;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_regimen_juridico", type="integer", nullable=false)
     */
    private $idRegimenJuridico;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_nivel_complejidad", type="integer", nullable=false)
     */
    private $idNivelComplejidad;

    /**
     * @var string
     *
     * @ORM\Column(name="claveestd", type="string", length=8, nullable=false)
     */
    private $claveestd;

    /**
     * @var string
     *
     * @ORM\Column(name="clavesisa", type="string", length=14, nullable=true)
     */
    private $clavesisa;

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
     * @var integer
     *
     * @ORM\Column(name="nodo", type="integer", nullable=false)
     */
    private $nodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="subnodo", type="smallint", nullable=false)
     */
    private $subnodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="internacion", type="integer", nullable=false)
     */
    private $internacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="baja", type="integer", nullable=false)
     */
    private $baja;

    /**
     * @var \Localidades
     *
     * @ORM\ManyToOne(targetEntity="Localidades")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_localidad", referencedColumnName="id_localidad")
     * })
     */
    private $idLocalidad;



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
     * Set idNodo
     *
     * @param integer $idNodo
     * @return Efectores
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
     * Set idSubnodo
     *
     * @param integer $idSubnodo
     * @return Efectores
     */
    public function setIdSubnodo($idSubnodo)
    {
        $this->idSubnodo = $idSubnodo;

        return $this;
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

    /**
     * Set idDependenciaAdm
     *
     * @param integer $idDependenciaAdm
     * @return Efectores
     */
    public function setIdDependenciaAdm($idDependenciaAdm)
    {
        $this->idDependenciaAdm = $idDependenciaAdm;

        return $this;
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

    /**
     * Set idRegimenJuridico
     *
     * @param integer $idRegimenJuridico
     * @return Efectores
     */
    public function setIdRegimenJuridico($idRegimenJuridico)
    {
        $this->idRegimenJuridico = $idRegimenJuridico;

        return $this;
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

    /**
     * Set idNivelComplejidad
     *
     * @param integer $idNivelComplejidad
     * @return Efectores
     */
    public function setIdNivelComplejidad($idNivelComplejidad)
    {
        $this->idNivelComplejidad = $idNivelComplejidad;

        return $this;
    }

    /**
     * Get idNivelComplejidad
     *
     * @return integer 
     */
    public function getIdNivelComplejidad()
    {
        return $this->idNivelComplejidad;
    }

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
     * Set clavesisa
     *
     * @param string $clavesisa
     * @return Efectores
     */
    public function setClavesisa($clavesisa)
    {
        $this->clavesisa = $clavesisa;

        return $this;
    }

    /**
     * Get clavesisa
     *
     * @return string 
     */
    public function getClavesisa()
    {
        return $this->clavesisa;
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
     * @param integer $nodo
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
     * @return integer 
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
     * @param integer $internacion
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
     * @return integer 
     */
    public function getInternacion()
    {
        return $this->internacion;
    }

    /**
     * Set baja
     *
     * @param integer $baja
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
     * @return integer 
     */
    public function getBaja()
    {
        return $this->baja;
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
