<?php

namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use STG\DEIM\Themes\Bundles\AplicativoBundle\Annotation\Filter;
use Symfony\Component\HttpFoundation\Request;

class FiltroService
{

    protected $em;
    protected $reader;
    protected $request;

    public function __construct(EntityManager $em, Request $request)
    {
        $this->em = $em;
        $this->reader = new AnnotationReader();
        $this->request = $request;
    }

    /**
     * generarConsultaFiltros
     * 
     * @param type $nombreEntidad
     * @param type $campo
     * @return \Doctrine\ORM\Query
     */
    public function generarConsultaFiltros($nombreEntidad, $campo)
    {
        $qb = $this->em->createQueryBuilder();

        $qb->add('select', 'a')
                ->add('from', $nombreEntidad . ' a')
                ->where("1=1");


        $termino = $this->request->get('term');

        // Si existe filtro
        if ($termino) {
            $qb->andWhere("a." . $campo . " LIKE :" . $campo)
                    ->setParameter($campo, '%' . $termino . '%');
        }

        return $qb->getQuery();
    }

    /**
     * generarConsultaMultiplesFiltros
     * 
     * @param string $nombreEntidad
     * @param array $filtros
     * @param string $orden
     * @return \Doctrine\ORM\Query
     */
    public function generarConsultaMultiplesFiltros($nombreEntidad, $filtros, $orden = null)
    {

        $qb = $this->em->createQueryBuilder();

        $qb->add('select', 'a')
                ->add('from', $nombreEntidad . ' a')
                ->where("1=1");

        foreach ($this->request->query as $campo => $termino) {

            if (($this->getTypeFiltroCampoFiltro($campo, $filtros) != 'fecha') &&
                    ($this->getTypeFiltroCampoFiltro($campo, $filtros) != 'entidad') &&
                    !$this->isFiltrable($filtros, $campo)) {
                continue;
            }
            if($termino == ''){
                continue;
            }
            
            if ($this->getTypeFiltroCampoFiltro($campo, $filtros) == 'text') {
                $qb->andWhere("a." . $campo . " LIKE :" . $campo)
                        ->setParameter($campo, '%' . $termino . '%');
                
            } elseif ($this->getTypeFiltroCampoFiltro($campo, $filtros) == 'fecha') {
                $this->addFechaFieldToQuery($qb, $campo);
                
            } elseif ($this->getTypeFiltroCampoFiltro($campo, $filtros) == 'entidad') {
                $qb->andWhere("a." . $campo . " = :" . $campo )
                        ->setParameter($campo, $termino);
                
            } else {
                $qb->andWhere("a." . $campo . " = :" . $campo)
                        ->setParameter($campo, $termino);
            }
        }

        if ($orden) {
            $qb->add('orderBy', 'a.' . $orden);
        }
        
        return $qb->getQuery();
    }

    /**
     * getFiltros
     * 
     * @param string $entityClass
     * @return array
     */
    public function getFiltros($entityClass)
    {
        $class = new \ReflectionClass($entityClass);
        $filtros = array();

        foreach ($class->getProperties() as $propiedad) {
            $filtros[] = $this->getFilterAnnotations($propiedad);
        }
        foreach ($filtros as $clave => $filtro) {
            if (!$filtro) {
                unset($filtros[$clave]);
            }
        }
        return $filtros;
    }

    /**
     * getRequestValueFiltro
     * 
     * @param type $nombrePropiedad
     * @return string 
     */
    private function getRequestValueFiltro($nombrePropiedad)
    {
        $requestQuery = $this->request->query;
        return $requestQuery->get($nombrePropiedad);
    }

    
    /**
     * getFilterAnnotations
     * 
     * @param \ReflectionProperty $propiedad
     * @return array
     */
    private function getFilterAnnotations(\ReflectionProperty $propiedad)
    {
        $annotations = $this->reader->getPropertyAnnotations($propiedad);
        $datosClase = $annotations[0];

        foreach ($annotations as $annotation) {
            if ($annotation instanceof Filter) {

                $typeFiltro = $annotation->type;
                $sourceFiltro = $annotation->source ? $annotation->source : '';
                
                if ($typeFiltro == 'fecha') {
                    $propiedadFiltro['inicio'] = $propiedad->name . '_inicio';
                    $propiedadFiltro['fin'] = $propiedad->name . '_fin';
                    $valueFiltro['inicio'] = $this->getRequestValueFiltro($propiedad->name . '_inicio');
                    $valueFiltro['fin'] = $this->getRequestValueFiltro($propiedad->name . '_fin');
                    
                } elseif ($typeFiltro == 'entidad') {

                    $propiedadFiltro = array(
                        'name' => $propiedad->name,
                        'entidades' => $this->getPropiedadesFiltroDesdeEntidad($annotation)
                    );
                    $valueFiltro = $this->getRequestValueFiltro($propiedad->name);
                    
                } else {
                    $propiedadFiltro = $propiedad->name;
                    $valueFiltro = $this->getRequestValueFiltro($propiedad->name);
                }

                $labelFiltro = $annotation->label ? $annotation->label : $propiedad->name;
                $labelFiltro = $this->splitWordsFromCamelCase($labelFiltro);
                $opcionesFiltro = $annotation->options;
                
                if ($typeFiltro) {
                    return array(
                        'columna' => isset($datosClase->name) ? $datosClase->name : '',
                        'type' => $typeFiltro,
                        'source' => $sourceFiltro,
                        'propiedad' => $propiedadFiltro,
                        'label' => $labelFiltro,
                        'value' => $valueFiltro,
                        'options' => $opcionesFiltro
                    );
                }
                break;
            }
        }
        return false;
    }
    
    
    /**
     * splitWordsFromCamelCase
     * 
     * @param string $string
     * @return string
     */
    private function splitWordsFromCamelCase($string)
    {
        $words = preg_split('/(?=[A-Z])/', $string);
        return implode(" ", $words);
    }

    
    /**
     * isFiltrable
     *
     * @param array $filtrosEntidad
     * @param string $campo
     * @return boolean
     */
    private function isFiltrable($filtrosEntidad, $campo)
    {
        foreach ($filtrosEntidad as $filtro) {
            if ($filtro['propiedad'] == $campo) {
                return true;
            }
        }
        return false;
    }

    
    /**
     * getTypeFiltroCampoFiltro
     * 
     * @param string $campo
     * @param array $filtros
     * @return string 
     */
    private function getTypeFiltroCampoFiltro($campo, $filtros)
    {
        foreach ($filtros as $filtro) {
            if (is_array($filtro['propiedad']) &&
                    array_key_exists('inicio', $filtro['propiedad']) &&
                    $filtro['propiedad']['inicio'] == $campo) {
                
                return $filtro['type'];
                
            } elseif ($filtro['propiedad'] == $campo) {
                return $filtro['type'];
            }
            
            elseif (is_array($filtro['propiedad']) &&
                    array_key_exists('name', $filtro['propiedad']) &&
                    $filtro['propiedad']['name'] == $campo) {
                return $filtro['type'];
            }
        }
        return false;
    }

    /**
     * addFechaFieldToQuery
     * 
     * @param \Doctrine\ORM\QueryBuilder $qb
     * @param string $campo
     */
    private function addFechaFieldToQuery(QueryBuilder $qb, $campo)
    {
        $campoFecha = str_replace('_inicio', '', $campo);
        $campoInicio = $this->getRequestValueFiltro($campoFecha . '_inicio');
        $campoFinal = $this->getRequestValueFiltro($campoFecha . '_fin');

        /*
         * Armar la consulta con >= , <= o BETWEEN según si completo uno o todos losca mpos
         */
        if (strlen($campoInicio) > 0 && strlen($campoFinal) > 0) {

            $dateTimeInicio = \DateTime::createFromFormat('d/m/Y', $this->request->query->get($campoFecha . '_inicio'));
            $dateTimeFinal = \DateTime::createFromFormat('d/m/Y', $this->request->query->get($campoFecha . '_fin'));

            $qb->andWhere("a." . $campoFecha . " BETWEEN :" . $campoFecha . '_inicio' . " AND :" . $campoFecha . '_fin')
                    ->setParameter($campoFecha . '_inicio', $dateTimeInicio)
                    ->setParameter($campoFecha . '_fin', $dateTimeFinal);
        } elseif (strlen($campoInicio) > 0 && strlen($campoFinal) == 0) {

            $dateTimeInicio = \DateTime::createFromFormat('d/m/Y', $this->request->query->get($campoFecha . '_inicio'));

            //TODO existe error en el formato de la fecha?
            $qb->andWhere("a." . $campoFecha . " >= :" . $campoFecha . '_inicio')
                    ->setParameter($campoFecha . '_inicio', $dateTimeInicio);
        } elseif (strlen($campoInicio) == 0 && strlen($campoFinal) > 0) {

            $dateTimeFinal = \DateTime::createFromFormat('d/m/Y', $this->request->query->get($campoFecha . '_fin'));

            $qb->andWhere("a." . $campoFecha . " <= :" . $campoFecha . '_fin')
                    ->setParameter($campoFecha . '_fin', $dateTimeFinal);
        }
    }

    /**
     * getPropiedadesFiltroDesdeEntidad
     * 
     * @param \STG\DEIM\Themes\Bundles\AplicativoBundle\Services\STG\DEIM\Themes\Bundles\AplicativoBundle\Annotation\Filter $annotation
     * @return array $filtros
     */
    private function getPropiedadesFiltroDesdeEntidad(Filter $annotation)
    {
        $query = $this->em->createQuery('SELECT u FROM ' . $annotation->class . ' u');
        $entidades = $query->execute(array(), Query::HYDRATE_ARRAY);

        $filtros = array();

        foreach ($entidades as $entidad) {
            $filtroEntidad = array('id' => $entidad[$annotation->classId], 'nombre' => $entidad[$annotation->className]);
            $filtros [] = $filtroEntidad;
        }
        return $filtros;
    }

}
