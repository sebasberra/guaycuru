<?php

namespace Guaycuru\DBHmi2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * NivelesComplejidades
 *
 * @ORM\Table(name="niveles_complejidades", uniqueConstraints={@ORM\UniqueConstraint(name="idx_unique_nivcomest", columns={"nivcomest"})})
 * @ORM\Entity
 */
class NivelesComplejidades
{
    /**
     * @var string
     *
     * @ORM\Column(name="nivcomest", type="string", length=4, nullable=false)
     */
    private $nivcomest;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=false)
     */
    private $descripcion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="id_nivel_complejidad", type="boolean")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idNivelComplejidad;



    /**
     * Set nivcomest
     *
     * @param string $nivcomest
     * @return NivelesComplejidades
     */
    public function setNivcomest($nivcomest)
    {
        $this->nivcomest = $nivcomest;

        return $this;
    }

    /**
     * Get nivcomest
     *
     * @return string 
     */
    public function getNivcomest()
    {
        return $this->nivcomest;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return NivelesComplejidades
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get idNivelComplejidad
     *
     * @return boolean 
     */
    public function getIdNivelComplejidad()
    {
        return $this->idNivelComplejidad;
    }
}
