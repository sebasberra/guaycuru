<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OperacionesCiexTitulosRestricciones
 *
 * @ORM\Table(name="operaciones_ciex_titulos_restricciones", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_operacion_titulo_id_ciex_titulo", columns={"id_ciex_titulo", "id_operacion_titulo"})}, indexes={@ORM\Index(name="idx_fk_operaciones_ciex_titulos_id_operacion_titulo", columns={"id_operacion_titulo"}), @ORM\Index(name="idx_fk_operaciones_ciex_titulos_id_ciex_titulo", columns={"id_ciex_titulo"})})
 * @ORM\Entity
 */
class OperacionesCiexTitulosRestricciones
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="restriccion", type="boolean", nullable=false)
     */
    private $restriccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_operacion_ciex_titulo_restriccion", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idOperacionCiexTituloRestriccion;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\OperacionesTitulos
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\OperacionesTitulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_operacion_titulo", referencedColumnName="id_operacion_titulo")
     * })
     */
    private $idOperacionTitulo;

    /**
     * @var \Guaycuru\DBHmi2Bundle\Entity\CiexTitulos
     *
     * @ORM\ManyToOne(targetEntity="Guaycuru\DBHmi2Bundle\Entity\CiexTitulos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_ciex_titulo", referencedColumnName="id_ciex_titulo")
     * })
     */
    private $idCiexTitulo;



    /**
     * Set restriccion
     *
     * @param boolean $restriccion
     * @return OperacionesCiexTitulosRestricciones
     */
    public function setRestriccion($restriccion)
    {
        $this->restriccion = $restriccion;

        return $this;
    }

    /**
     * Get restriccion
     *
     * @return boolean 
     */
    public function getRestriccion()
    {
        return $this->restriccion;
    }

    /**
     * Get idOperacionCiexTituloRestriccion
     *
     * @return integer 
     */
    public function getIdOperacionCiexTituloRestriccion()
    {
        return $this->idOperacionCiexTituloRestriccion;
    }

    /**
     * Set idOperacionTitulo
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\OperacionesTitulos $idOperacionTitulo
     * @return OperacionesCiexTitulosRestricciones
     */
    public function setIdOperacionTitulo(\Guaycuru\DBHmi2Bundle\Entity\OperacionesTitulos $idOperacionTitulo = null)
    {
        $this->idOperacionTitulo = $idOperacionTitulo;

        return $this;
    }

    /**
     * Get idOperacionTitulo
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\OperacionesTitulos 
     */
    public function getIdOperacionTitulo()
    {
        return $this->idOperacionTitulo;
    }

    /**
     * Set idCiexTitulo
     *
     * @param \Guaycuru\DBHmi2Bundle\Entity\CiexTitulos $idCiexTitulo
     * @return OperacionesCiexTitulosRestricciones
     */
    public function setIdCiexTitulo(\Guaycuru\DBHmi2Bundle\Entity\CiexTitulos $idCiexTitulo = null)
    {
        $this->idCiexTitulo = $idCiexTitulo;

        return $this;
    }

    /**
     * Get idCiexTitulo
     *
     * @return \Guaycuru\DBHmi2Bundle\Entity\CiexTitulos 
     */
    public function getIdCiexTitulo()
    {
        return $this->idCiexTitulo;
    }
}
