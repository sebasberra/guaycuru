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
 * **Tabla: Localidades**
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
 *      name="localidades", 
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(
 *              name="idx_unique_cod_loc_cod_dpto_cod_prov_cod_pais", 
 *              columns={"cod_loc", "cod_dpto", "cod_prov", "cod_pais"})
 *      }, 
 *      indexes={
 *          @ORM\Index(
 *              name="idx_fk_localidades_id_dpto", 
 *              columns={"id_dpto"}), 
 *          @ORM\Index(
 *              name="idx_nom_loc", 
 *              columns={"nom_loc"})
 *      })
 * 
 * @ORM\Entity
 * 
 */
class Localidades
{
    /**
     * @var integer Clave primaria
     *
     * @ORM\Column(name="id_localidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idLocalidad;

    /**
     * @var integer No se utiliza en esta implementación
     *
     * @ORM\Column(name="id_dpto", type="integer", nullable=true)
     */
    private $idDpto;

    /**
     * @var string Nombre de localidad
     *
     * @ORM\Column(name="nom_loc", type="string", length=50, nullable=false)
     */
    private $nomLoc;

    /**
     * @var string Codificación de localidad que utiliza estadística
     *
     * @ORM\Column(name="cod_loc", type="string", length=2, nullable=false)
     */
    private $codLoc;

    /**
     * @var string Codificación de departamento que utiliza estadística
     *
     * @ORM\Column(name="cod_dpto", type="string", length=3, nullable=false)
     */
    private $codDpto;

    /**
     * @var string Codificación de provincia que utiliza estadística
     *
     * @ORM\Column(name="cod_prov", type="string", length=2, nullable=false)
     */
    private $codProv;

    /**
     * @var string Codificación de país que utiliza estadística
     *
     * @ORM\Column(name="cod_pais", type="string", length=3, nullable=false)
     */
    private $codPais;

    /**
     * @var string Código postal de 4 dígitos
     *
     * @ORM\Column(name="cod_postal", type="string", length=4, nullable=true)
     */
    private $codPostal;



    /**
     * Get idLocalidad
     *
     * @return integer
     */
    public function getIdLocalidad()
    {
        return $this->idLocalidad;
    }

    /**
     * Set idDpto
     *
     * @param integer $idDpto
     *
     * @return Localidades
     */
    public function setIdDpto($idDpto)
    {
        $this->idDpto = $idDpto;

        return $this;
    }

    /**
     * Get idDpto
     *
     * @return integer
     */
    public function getIdDpto()
    {
        return $this->idDpto;
    }

    /**
     * Set nomLoc
     *
     * @param string $nomLoc
     *
     * @return Localidades
     */
    public function setNomLoc($nomLoc)
    {
        $this->nomLoc = $nomLoc;

        return $this;
    }

    /**
     * Get nomLoc
     *
     * @return string
     */
    public function getNomLoc()
    {
        return $this->nomLoc;
    }

    /**
     * Set codLoc
     *
     * @param string $codLoc
     *
     * @return Localidades
     */
    public function setCodLoc($codLoc)
    {
        $this->codLoc = $codLoc;

        return $this;
    }

    /**
     * Get codLoc
     *
     * @return string
     */
    public function getCodLoc()
    {
        return $this->codLoc;
    }

    /**
     * Set codDpto
     *
     * @param string $codDpto
     *
     * @return Localidades
     */
    public function setCodDpto($codDpto)
    {
        $this->codDpto = $codDpto;

        return $this;
    }

    /**
     * Get codDpto
     *
     * @return string
     */
    public function getCodDpto()
    {
        return $this->codDpto;
    }

    /**
     * Set codProv
     *
     * @param string $codProv
     *
     * @return Localidades
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
     * Set codPais
     *
     * @param string $codPais
     *
     * @return Localidades
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
     * Set codPostal
     *
     * @param string $codPostal
     *
     * @return Localidades
     */
    public function setCodPostal($codPostal)
    {
        $this->codPostal = $codPostal;

        return $this;
    }

    /**
     * Get codPostal
     *
     * @return string
     */
    public function getCodPostal()
    {
        return $this->codPostal;
    }
}
