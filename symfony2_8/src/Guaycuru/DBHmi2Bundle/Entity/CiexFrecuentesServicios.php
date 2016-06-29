<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CiexFrecuentesServicios
 *
 * @ORM\Table(name="ciex_frecuentes_servicios", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_id_servicio_id_ciex_4", columns={"id_servicio", "id_ciex_4"}), @ORM\UniqueConstraint(name="idx_unique_cod_servicio_cod_3dig_cod_4dig", columns={"cod_servicio", "cod_3dig", "cod_4dig"})})
 * @ORM\Entity
 */
class CiexFrecuentesServicios
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_servicio", type="integer", nullable=true)
     */
    private $idServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ciex_4", type="integer", nullable=false)
     */
    private $idCiex4;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_servicio", type="string", length=3, nullable=true)
     */
    private $codServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_3dig", type="string", length=3, nullable=false)
     */
    private $cod3dig;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_4dig", type="string", length=1, nullable=false)
     */
    private $cod4dig;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_ciex_frecuente_servicio", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idCiexFrecuenteServicio;



    /**
     * Set idServicio
     *
     * @param integer $idServicio
     * @return CiexFrecuentesServicios
     */
    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;

        return $this;
    }

    /**
     * Get idServicio
     *
     * @return integer 
     */
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    /**
     * Set idCiex4
     *
     * @param integer $idCiex4
     * @return CiexFrecuentesServicios
     */
    public function setIdCiex4($idCiex4)
    {
        $this->idCiex4 = $idCiex4;

        return $this;
    }

    /**
     * Get idCiex4
     *
     * @return integer 
     */
    public function getIdCiex4()
    {
        return $this->idCiex4;
    }

    /**
     * Set codServicio
     *
     * @param string $codServicio
     * @return CiexFrecuentesServicios
     */
    public function setCodServicio($codServicio)
    {
        $this->codServicio = $codServicio;

        return $this;
    }

    /**
     * Get codServicio
     *
     * @return string 
     */
    public function getCodServicio()
    {
        return $this->codServicio;
    }

    /**
     * Set cod3dig
     *
     * @param string $cod3dig
     * @return CiexFrecuentesServicios
     */
    public function setCod3dig($cod3dig)
    {
        $this->cod3dig = $cod3dig;

        return $this;
    }

    /**
     * Get cod3dig
     *
     * @return string 
     */
    public function getCod3dig()
    {
        return $this->cod3dig;
    }

    /**
     * Set cod4dig
     *
     * @param string $cod4dig
     * @return CiexFrecuentesServicios
     */
    public function setCod4dig($cod4dig)
    {
        $this->cod4dig = $cod4dig;

        return $this;
    }

    /**
     * Get cod4dig
     *
     * @return string 
     */
    public function getCod4dig()
    {
        return $this->cod4dig;
    }

    /**
     * Get idCiexFrecuenteServicio
     *
     * @return integer 
     */
    public function getIdCiexFrecuenteServicio()
    {
        return $this->idCiexFrecuenteServicio;
    }
}
