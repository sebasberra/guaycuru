<?php
/**
 * Proyecto Final Ingeniería Informática 2017 - UNL - Santa Fe - Argentina
 * 
 * Web Services Plataforma Web para centralización de camas críticas de internación en hospitales de la Provincia de Santa Fe
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 * 
 * @version 0.1.0
 */
namespace RI\DBHmi2GuaycuruCamasBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * **Tabla: Efectores**
 * 
 * @api *Librería de acceso a la base de datos centralizada del sistema de camas críticas de internación*
 * 
 * @author Sebastián Berra <sebasberra@yahoo.com.ar>
 *  
 * @link http://www.doctrine-project.org
 * Doctrine Project
 * 
 * @link https://symfony.com/doc/current/doctrine.html
 * Symfony - Databases and the Doctrine ORM
 *
 *
 * @ORM\Table(
 *      name="efectores", 
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="idx_unique_claveestd", 
 *              columns={"claveestd"})
 *          }, 
 *      indexes={
 *          @ORM\Index(
 *              name="idx_fk_efectores_id_localidad", 
 *              columns={"id_localidad"}), 
 *          @ORM\Index(
 *              name="idx_fk_efectores_id_dependencia_adm", 
 *              columns={"id_dependencia_adm"}), 
 *          @ORM\Index(
 *              name="idx_fk_efectores_id_regimen_juridico", 
 *              columns={"id_regimen_juridico"}), 
 *          @ORM\Index(
 *              name="idx_fk_efectores_id_nodo", 
 *              columns={"id_nodo"}), 
 *          @ORM\Index(
 *              name="idx_fk_efectores_id_subnodo", 
 *              columns={"id_subnodo"}), 
 *          @ORM\Index(
 *              name="idx_fk_efectores_id_nivel_complejidad", 
 *              columns={"id_nivel_complejidad"}), 
 *          @ORM\Index(
 *              name="idx_clavesisa", 
 *              columns={"clavesisa"})
 *          }
 *      )
 * 
 * @ORM\Entity(repositoryClass="RI\DBHmi2GuaycuruCamasBundle\Entity\EfectoresRepository")
 * 
 */
class Efectores
{
    /**
     * @var integer Clave primaria
     *
     * @ORM\Column(name="id_efector", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEfector;

    /**
     * @var integer 1=Reconquista; 2=Rafaela; 3=Santa Fe; 4=Rosario; 5=Venado Tuerto; 6=No definido
     *
     * @ORM\Column(name="id_nodo", type="smallint", nullable=false)
     */
    private $idNodo;

    /**
     * @var integer No se utiliza en esta implementación
     *
     * @ORM\Column(name="id_subnodo", type="smallint", nullable=false)
     */
    private $idSubnodo;

    /**
     * @var smallint 
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr><td>1</td><td>Oficial Nacional	 	</td></tr>
     * <tr><td>2</td><td>Fuerzas Armadas	 	</td></tr>
     * <tr><td>3</td><td>Otros Nacionales	 	</td></tr>
     * <tr><td>4</td><td>Oficial Provincial	 	</td></tr>
     * <tr><td>5</td><td>Otros Provinciales	 	</td></tr>
     * <tr><td>6</td><td>Comunidad	         	</td></tr>
     * <tr><td>7</td><td>Obra Social	        </td></tr>
     * <tr><td>8</td><td>Privado	            </td></tr>
     * <tr><td>9</td><td>Universitario	     	</td></tr>
     * <tr><td>10</td><td>Mutual	            </td></tr>
     * <tr><td>11</td><td>Privado Universitario </td></tr>
     * <tr><td>12</td><td>Laboral Universitario </td></tr>
     * <tr><td>13</td><td>Municipal	         	</td></tr>
     * <tr><td>14</td><td>Provincia Comunidad	</td></tr></table>
     *
     * @ORM\Column(name="id_dependencia_adm", type="smallint", nullable=true)
     */
    private $idDependenciaAdm;

    /**
     * @var smallint
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr><td>1</td><td>	Dep. de SAMCo.						</td></tr>
     * <tr><td>2</td><td>	Descentralizado - Ley Prov. 10608	</td></tr>
     * <tr><td>3</td><td>	Provincial- Decreto Nacional 939	</td></tr>
     * <tr><td>4</td><td>	SAMCo. Ley Provincial 6312/67	    </td></tr>
     * <tr><td>5</td><td>	Municipal/Comunal	                </td></tr>
     * <tr><td>6</td><td>	Comunal/Municipal	                </td></tr>
     * <tr><td>7</td><td>	O.N.G. - Ley Provincial 9847	    </td></tr>
     * <tr><td>8</td><td>	No definido	                        </td></tr></table>
     * 
     * @ORM\Column(name="id_regimen_juridico", type="smallint", nullable=false)
     */
    private $idRegimenJuridico;

    /**
     * @var smallint
     * <table cellpadding="0" cellspacing="0" border="1" style="border-style: solid; border-color: #cccccc #cccccc;">
     * <tr><td>1</td><td>S/D		</td></tr>	
     * <tr><td>2</td><td>Especializados </td></tr>
     * <tr><td>3</td><td>I              </td></tr>
     * <tr><td>4</td><td>II             </td></tr>
     * <tr><td>5</td><td>III            </td></tr>
     * <tr><td>6</td><td>IV             </td></tr>
     * <tr><td>7</td><td>IX             </td></tr>
     * <tr><td>8</td><td>V              </td></tr>
     * <tr><td>9</td><td>VI             </td></tr>
     * <tr><td>10</td><td>VIII        	</td></tr></table>
     * 
     * @ORM\Column(name="id_nivel_complejidad", type="smallint", nullable=false)
     */
    private $idNivelComplejidad;

    /**
     * @var string Clave de establecimiento definida por la Dirección Gral. de Estadística
     *
     * @ORM\Column(name="claveestd", type="string", length=8, nullable=false)
     */
    private $claveestd;

    /**
     * @var string Clave SISA (Sistema Integrado de Información Argentino)
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
     * @var string Tipo establecimiento para el informe de estadística
     *
     * @ORM\Column(name="nom_efector", type="string", length=255, nullable=false)
     */
    private $nomEfector;

    /**
     * @var string Nombre reducido del efector
     *
     * @ORM\Column(name="nom_red_efector", type="string", length=50, nullable=false)
     */
    private $nomRedEfector;

    /**
     * @var smallint 1=Reconquista; 2=Rafaela; 3=Santa Fe; 4=Rosario; 5=Venado Tuerto; 6=No definido
     *
     * @ORM\Column(name="nodo", type="smallint", nullable=false)
     */
    private $nodo;

    /**
     * @var integer No se utiliza en esta implementación
     *
     * @ORM\Column(name="subnodo", type="smallint", nullable=false)
     */
    private $subnodo;

    /**
     * @var boolean Bandera de efector con o sin internación
     *
     * @ORM\Column(name="internacion", type="boolean", nullable=false)
     */
    private $internacion;

    /**
     * @var boolean Bandera del registro de efector activo o no activo
     *
     * @ORM\Column(name="baja", type="boolean", nullable=false)
     */
    private $baja;

    /**
     * @var \Localidades Localidad donde está ubicado el efector
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
     *
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
     *
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
     * @param smallint $idDependenciaAdm
     *
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
     * @return smallint
     */
    public function getIdDependenciaAdm()
    {
        return $this->idDependenciaAdm;
    }

    /**
     * Set idRegimenJuridico
     *
     * @param smallint $idRegimenJuridico
     *
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
     * @return smallint
     */
    public function getIdRegimenJuridico()
    {
        return $this->idRegimenJuridico;
    }

    /**
     * Set idNivelComplejidad
     *
     * @param smallint $idNivelComplejidad
     *
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
     * @return smallint
     */
    public function getIdNivelComplejidad()
    {
        return $this->idNivelComplejidad;
    }

    /**
     * Set claveestd
     *
     * @param string $claveestd
     *
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
     *
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
     *
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
     *
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
     *
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
     * @param smallint $nodo
     *
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
     * @return smallint
     */
    public function getNodo()
    {
        return $this->nodo;
    }

    /**
     * Set subnodo
     *
     * @param integer $subnodo
     *
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
     *
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
     *
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
     * Set idLocalidad
     *
     * @param \RI\DBHmi2GuaycuruCamasBundle\Entity\Localidades $idLocalidad
     *
     * @return Efectores
     */
    public function setIdLocalidad(\RI\DBHmi2GuaycuruCamasBundle\Entity\Localidades $idLocalidad = null)
    {
        $this->idLocalidad = $idLocalidad;

        return $this;
    }

    /**
     * Get idLocalidad
     *
     * @return \RI\DBHmi2GuaycuruCamasBundle\Entity\Localidades
     */
    public function getIdLocalidad()
    {
        return $this->idLocalidad;
    }
    
    /**
     * Implementación __toString
     *
     * @return string Nombre del efector
     */
    public function __toString()
    {
      return $this->nomEfector;
      
    }
}
