<?php

namespace RI\RIWebServicesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIFormularios;
use RI\RIWebServicesBundle\Utils\Test\WSTest;

use RI\RIWebServicesBundle\Utils\Formularios\FormulariosTestWS;
use RI\RIWebServicesBundle\Utils\Render\Render;
use RI\RIWebServicesBundle\Utils\Render\RenderTest;


class TestController extends Controller
{
    
    use FormulariosTestWS,
        Render,
        RenderTest;
    
    /** 
    * @Route("/")
    */
    public function formularioTestWSAction(){
        
        return $this->render("RIWebServicesBundle:Test:RITestWS.html.twig");
        
    }
    
    
    /**
    * @Route("/camas")
    */
    public function testWSCamasAction(
            Request $request)
    {
        
        try {

            $form = 
                    $this->crearFormularioTestWS(
                            $request,
                            RIFormularios::TEST_WS_FORM_CAMAS);

            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {

                return $this->renderRedireccionarTestWS($form);

            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion testWSCamasAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la página de test web services', 
                    $msg);

        }
    
        return $this->renderFormularioTestWS(
                $form,
                WSTest::WS_TEST_INICIO,
                RIFormularios::TEST_WS_FORM_CAMAS,
                '');
        
    }
    
    /**
    * @Route("/habitaciones")
    */
    public function testWSHabitacionesAction(
            Request $request)
    {
        
        try {

            $form = 
                    $this->crearFormularioTestWS(
                            $request,
                            RIFormularios::TEST_WS_FORM_HABITACIONES);

            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {

                return $this->renderRedireccionarTestWS($form);

            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion testWSHabitacionesAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la página de test web services', 
                    $msg);

        }
    
        return $this->renderFormularioTestWS(
                $form,
                WSTest::WS_TEST_INICIO,
                RIFormularios::TEST_WS_FORM_HABITACIONES,
                '');
        
    }
    
    /**
    * @Route("/salas")
    */
    public function testWSSalasAction(
            Request $request)
    {
        
        try {

            $form = 
                    $this->crearFormularioTestWS(
                            $request,
                            RIFormularios::TEST_WS_FORM_SALAS);

            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {

                return $this->renderRedireccionarTestWS($form);

            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion testWSSalasAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la página de test web services', 
                    $msg);

        }
    
        return $this->renderFormularioTestWS(
                $form,
                WSTest::WS_TEST_INICIO,
                RIFormularios::TEST_WS_FORM_SALAS,
                '');
        
    }
}
