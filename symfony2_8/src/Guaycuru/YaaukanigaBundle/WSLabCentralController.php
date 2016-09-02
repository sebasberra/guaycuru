<?php

/*
 * Orden: Alta y Modificacion permite cambio campo Anulado
 * OrdenAnalisis: Alta y Modificacion permite cambio campo Anulado
 * OrdenDeterminacion: Alta y Modificacion
 * Pendiente:
 * -> Confirmar autenticación con Armando
 * -> Agregar metodo para cargar derivaciones, de esa manera tenemos marcadas las determinaciones derivadas y que podría modificar un tercero, agregar marca
 * que permita identificador del tercero que puede modificar
 * -> Agregar metodo para cargar diagnostico y valores de formulario
 * -> Ver como 
 * 
 */

namespace labcentral\WSBundle\Controller;

use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Symfony\Component\DependencyInjection\ContainerAware;
use labcentral\WSBundle\Entity\LabtOrden;
use labcentral\WSBundle\Entity\LabtOrdenDeterminacion;
use labcentral\WSBundle\Entity\LabtOrdenAnalisis;
use labcentral\WSBundle\Entity\LabtOrdenDiagnostico;
use labcentral\WSBundle\Entity\LabtMedico;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @Soap\Header("api_key", phpType = "string")
 * @Soap\Header("claveestd", phpType = "string")
 */
class WSLabCentralController extends ContainerAware {

    private $mi_claveestd = '';

    /**
     * @Soap\Method("cargaOrden")
     * @Soap\Param("orden_id", phpType = "int")
     * @Soap\Param("sucursal", phpType = "int")
     * @Soap\Param("nro", phpType = "int")
     * @Soap\Param("fecha", phpType = "date")
     * @Soap\Param("paciente_id", phpType = "int")
     * @Soap\Param("medico_id", phpType = "int")
     * @Soap\Param("derivacion", phpType = "int")
     * @Soap\Param("servicio_sector_id", phpType = "string")
     * @Soap\Param("servicio_subsector_id", phpType = "string") 
     * @Soap\Param("servicio_codservicio", phpType = "string")
     * @Soap\Param("servicio_claveestd", phpType = "string")
     * @Soap\Param("NumeroPaciente", phpType = "int")
     * @Soap\Param("observacion", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function cargaOrdenAction($orden_id, $sucursal, $nro, $fecha, $paciente_id, $medico_id, $derivacion, $servicio_sector_id, $servicio_subsector_id, $servicio_codservicio, $servicio_claveestd, $NumeroPaciente, $observacion) {
        return $this->cargaOrden($orden_id, $sucursal, $nro, $fecha, $paciente_id, $medico_id, $derivacion, $servicio_sector_id, $servicio_subsector_id, $servicio_codservicio, $servicio_claveestd, $NumeroPaciente, $observacion);
    }

    function cargaOrden($orden_id, $sucursal, $nro, $fecha, $paciente_id, $medico_id, $derivacion, $servicio_sector_id, $servicio_subsector_id, $servicio_codservicio, $servicio_claveestd, $NumeroPaciente, $observacion) {

        $em = $this->container->get('doctrine.orm.entity_manager');

        $labt_orden = new LabtOrden();

        $labt_orden->setClaveestd($this->mi_claveestd);
        $labt_orden->setOrdenId($orden_id);
        $labt_orden->setSucursal($sucursal);
        $labt_orden->setNro($nro);
        $labt_orden->setFecha($fecha);
        $labt_orden->setPacienteId($paciente_id);
        $labt_orden->setMedicoId($medico_id);
        $labt_orden->setDerivacion($derivacion);
        $labt_orden->setServicioSectorId($servicio_sector_id);
        $labt_orden->setServicioSubsectorId($servicio_subsector_id);
        $labt_orden->setServicioCodservicio($servicio_codservicio);
        $labt_orden->setServicioClaveestd($servicio_claveestd);
        $labt_orden->setNumeropaciente($NumeroPaciente);
        $labt_orden->setObservacion($observacion);
        $labt_orden->setFechaCarga(new \DateTime());
        $em->merge($labt_orden);

        try {
            $em->flush();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * @Soap\Method("anulaOrden")
     * @Soap\Param("orden_id", phpType = "int")
     * @Soap\Param("anula", phpType = "boolean")
     * @Soap\Result(phpType = "boolean")
     */
    public function anulaOrdenAction($orden_id, $anula) {
        return $this->anulaOrden($orden_id, $anula);
    }

    function anulaOrden($orden_id, $anula) {

        $em = $this->container->get('doctrine.orm.entity_manager');
        $orden = $this->getOrden($this->mi_claveestd, $orden_id);

        if ($orden != null) {
            $orden->setAnulado($anula);
            $em->merge($orden);
            try {
                $em->flush();
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            throw new \SoapFault('ORDEN_NO_EXISTE', 'orden no existe');
        }
        return false;
    }

    /**
     * @Soap\Method("anulaOrdenAnalisis")
     * @Soap\Param("orden_analisis_id", phpType = "int")
     * @Soap\Param("anula", phpType = "boolean")
     * @Soap\Result(phpType = "boolean")
     */
    public function anulaOrdenAnalisisAction($orden_analisis_id, $anula) {
        return $this->anulaOrdenAnalisis($orden_analisis_id, $anula);
    }

    function anulaOrdenAnalisis($orden_analisis_id, $anula) {

        $em = $this->container->get('doctrine.orm.entity_manager');
        $orden_analisis = $this->getOrdenAnalisis($this->mi_claveestd, $orden_analisis_id);

        if ($orden_analisis != null) {
            $orden_analisis->setAnulado($anula);
            $em->merge($orden_analisis);
            try {
                $em->flush();
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            throw new \SoapFault('ORDEN_ANALISIS_NO_EXISTE', 'orden analisis no existe');
        }
        return false;
    }

    /**
     * @Soap\Method("cargaOrdenAnalisis")
     * @Soap\Param("orden_analisis_id", phpType = "int")
     * @Soap\Param("orden_id", phpType = "int")
     * @Soap\Param("analisis_codigo", phpType = "string")
     * @Soap\Param("observacion", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function cargaOrdenAnalisisAction($orden_analisis_id, $orden_id, $analisis_codigo, $observacion) {
        return $this->cargaOrdenAnalisis($orden_analisis_id, $orden_id, $analisis_codigo, $observacion);
    }

    function cargaOrdenAnalisis($orden_analisis_id, $orden_id, $analisis_codigo, $observacion) {

        $em = $this->container->get('doctrine.orm.entity_manager');

        $orden = $this->getOrden($this->mi_claveestd, $orden_id);
        $this->checkOrdenAnulada($orden);

        if ($orden != null) {

            $labt_orden_analisis = new LabtOrdenAnalisis();

            $labt_orden_analisis->setClaveestd($this->mi_claveestd);
            $labt_orden_analisis->setOrdenAnalisisId($orden_analisis_id);
            $labt_orden_analisis->setOrdenId($orden_id);
            $labt_orden_analisis->setAnalisisCodigo($analisis_codigo);
            $labt_orden_analisis->setObservacion($observacion);
            $em->merge($labt_orden_analisis);
            try {
                $em->flush();
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            throw new \SoapFault('ORDEN_NO_EXISTE', 'orden no existe');
        }
    }

    /**
     * @Soap\Method("cargaOrdenDeterminacion")
     * @Soap\Param("orden_determinacion_id", phpType = "int")
     * @Soap\Param("orden_id", phpType = "int")
     * @Soap\Param("analisis_codigo", phpType = "string")
     * @Soap\Param("determinacion_codigo", phpType = "string")
     * @Soap\Param("resultado", phpType = "string")
     * @Soap\Param("metodo_codigo", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function cargaOrdenDeterminacionAction($orden_determinacion_id, $orden_id, $analisis_codigo, $determinacion_codigo, $metodo_codigo, $resultado) {
        return $this->cargaOrdenDeterminacion($orden_determinacion_id, $orden_id, $analisis_codigo, $determinacion_codigo, $metodo_codigo, $resultado);
    }

    function cargaOrdenDeterminacion($orden_determinacion_id, $orden_id, $analisis_codigo, $determinacion_codigo, $metodo_codigo, $resultado) {

        $em = $this->container->get('doctrine.orm.entity_manager');
        $orden = $this->getOrden($this->mi_claveestd, $orden_id);
        $this->checkOrdenAnulada($orden);

        if ($orden != null) {
            $labt_orden_determinacion = new LabtOrdenDeterminacion();

            $labt_orden_determinacion->setClaveestd($this->mi_claveestd);
            $labt_orden_determinacion->setOrdenDeterminacionId($orden_determinacion_id);
            $labt_orden_determinacion->setOrdenId($orden_id);
            $labt_orden_determinacion->setAnalisisCodigo($analisis_codigo);
            $labt_orden_determinacion->setDeterminacionCodigo($determinacion_codigo);
            $labt_orden_determinacion->setMetodoCodigo($metodo_codigo);
            $labt_orden_determinacion->setResultado($resultado);

            $em->merge($labt_orden_determinacion);

            try {
                $em->flush();
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            throw new \SoapFault('ORDEN_NO_EXISTE', 'orden no existe');
        }
    }

    /**
     * @Soap\Method("cargaOrdenDiagnostico")
     * @Soap\Param("orden_diagnostico_id", phpType = "int")
     * @Soap\Param("orden_id", phpType = "int")
     * @Soap\Param("diagnostico_tipo", phpType = "int")
     * @Soap\Param("diagnostico_id", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function cargaOrdenDiagnosticoAction($orden_diagnostico_id, $orden_id, $diagnostico_tipo, $diagnostico_id) {
        return $this->cargaOrdenDiagnostico($orden_diagnostico_id, $orden_id, $diagnostico_tipo, $diagnostico_id);
    }

    function cargaOrdenDiagnostico($orden_diagnostico_id, $orden_id, $diagnostico_tipo, $diagnostico_id) {

        $em = $this->container->get('doctrine.orm.entity_manager');

        $orden = $this->getOrden($this->mi_claveestd, $orden_id);
        $this->checkOrdenAnulada($orden);

        if ($orden != null) {

            $labt_orden_diagnostico = new LabtOrdenDiagnostico();

            $labt_orden_diagnostico->setClaveestd($this->mi_claveestd);
            $labt_orden_diagnostico->setOrdenDiagnosticoId($orden_diagnostico_id);
            $labt_orden_diagnostico->setOrdenId($orden_id);
            $labt_orden_diagnostico->setDiagnosticoTipo($diagnostico_tipo);
            $labt_orden_diagnostico->setDiagnosticoId($diagnostico_id);
            $em->merge($labt_orden_diagnostico);
            try {
                $em->flush();
                return true;
            } catch (Exception $e) {
                return false;
            }
        } else {
            throw new \SoapFault('ORDEN_NO_EXISTE', 'orden no existe');
        }
    }

    /**
     * @Soap\Method("cargaOrdenFormulario")
     * @Soap\Param("orden_formulario_id", phpType = "int")
     * @Soap\Param("orden_id", phpType = "int")
     * @Soap\Param("formulario_codigo", phpType = "string")
     * @Soap\Param("campo_codigo", phpType = "string")
     * @Soap\Param("orden_formulario_resultado", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function cargaOrdenFormularioAction($orden_formulario_id, $orden_id, $formulario_codigo, $campo_codigo, $orden_formulario_resultado) {
        return $this->cargaOrdenFormulario($orden_formulario_id, $orden_id, $formulario_codigo, $campo_codigo, $orden_formulario_resultado);
    }

    function cargaOrdenFormulario($orden_formulario_id, $orden_id, $formulario_codigo, $campo_codigo, $orden_formulario_resultado) {

        $em = $this->container->get('doctrine.orm.entity_manager');

        $orden = $this->getOrden($this->mi_claveestd, $orden_id);
        $this->checkOrdenAnulada($orden);

        if ($orden != null) {
            /*
             * controlar carga previa de esa ordenformulario?
             * verificar para códigos de embarazo en particular, actualizar tabla embarazos sicap
             * que se cargue primero orden formulario desde los diagnose, para que despues los diagnósticos de embarazo tengan el valor de la fum ¿es posible?
             * 
             */
        } else {
            throw new \SoapFault('ORDEN_NO_EXISTE', 'orden no existe');
        }
    }

    /**
     * @Soap\Method("cargaMedico")
     * @Soap\Param("medico_id", phpType = "int")
     * @Soap\Param("matricula", phpType = "int")
     * @Soap\Param("nombre", phpType = "string")
     * @Soap\Result(phpType = "boolean")
     */
    public function cargacargaMedicoAction($medico_id, $matricula, $nombre) {
        return $this->cargaMedico($medico_id, $matricula, $nombre);
    }

    function cargaMedico($medico_id, $matricula, $nombre) {

        $em = $this->container->get('doctrine.orm.entity_manager');
        
        $labt_medico = new LabtMedico();

        $labt_medico->setClaveestd($this->mi_claveestd);
        $labt_medico->setMedicoId($medico_id);
        $labt_medico->setMatricula($matricula);
        $labt_medico->setNombre($nombre);
        
        $em->merge($labt_medico);
        try {
            $em->flush();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    private function getOrden($claveestd, $orden_id) {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('labcentralWSBundle:LabtOrden')->find(array("claveestd" => $claveestd, "ordenId" => $orden_id));
        return $entity;
    }

    private function getOrdenAnalisis($claveestd, $orden_analisis_id) {
        $em = $this->container->get('doctrine.orm.entity_manager');
        $entity = $em->getRepository('labcentralWSBundle:LabtOrdenAnalisis')->find(array("claveestd" => $claveestd, "ordenAnalisisId" => $orden_analisis_id));
        return $entity;
    }

    private function checkOrdenAnulada($orden) {
        if ($orden != null) {
            if ($orden->getAnulado() == true)
                throw new \SoapFault('ORDEN_ANULADA', 'orden anulada');
        }else {
            throw new \SoapFault('ORDEN_NO_EXISTE', 'orden no existe');
        }
    }

    public function setContainer(ContainerInterface $container = null) {
        parent::setContainer($container);

        $this->checkApiKeyHeader();
    }

    private function checkApiKeyHeader() {
        $soapHeaders = $this->container->get('request')->getSoapHeaders();

        $api_key = '1234';
        

        if ((!$soapHeaders->has('api_key') || $api_key !== $soapHeaders->get('api_key')->getData()) || !$soapHeaders->has('claveestd')) {
            throw new \SoapFault("INVALID_ACCESS", "Acceso invalido");
        } else {
            $this->mi_claveestd = $soapHeaders->get('claveestd')->getData();
        }
    }

}
