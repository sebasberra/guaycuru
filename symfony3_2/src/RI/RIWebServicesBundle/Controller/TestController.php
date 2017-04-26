<?php

namespace RI\RIWebServicesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIFormularios;
use RI\RIWebServicesBundle\Utils\Test\WSTest;

use RI\RIWebServicesBundle\Utils\Formularios\FormulariosTestWS;


class TestController extends Controller
{
    
    use FormulariosTestWS;
    
    
    /** 
    * @Route("/")
    */
    public function formularioTestWSAction(){
        
        return $this->render("RIWebServicesBundle:Test:RITestWS.html.twig");
        
    }
    
    /**
    * @Route("/combos")
    */
    public function testCombosAction(Request $request)
    {
        
        try {

            $this->get('app.ri_formularios');
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\Test\TestCombosType');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted()) {

                dump($request);die();
            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion testCombosAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la página de test web services', 
                    $msg);

        }
    
        return $this->render(
                "RIWebServicesBundle:Test:RITestCombos.html.twig",
                array(
                    'form' =>$form->createView()
                ));
        
    }
    
    
    /**
    * @Route("/combos2")
    */
    public function testCombos2Action(Request $request)
    {
        
        try {

            $this->get('app.ri_formularios');
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\Test\TestCombos2Type');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {


            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion testCombosAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la página de test web services', 
                    $msg);

        }
    
        return $this->render(
                "RIWebServicesBundle:Test:RITestCombos2.html.twig",
                array(
                    'form' =>$form->createView()
                ));
        
    }
    
    
    /**
    * @Route("/combos3")
    */
    public function testCombos3Action(Request $request)
    {
        
        try {

            $this->get('app.ri_formularios');
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\Test\TestCombos3Type');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {


            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion testCombos3Action: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la página de test web services', 
                    $msg);

        }
    
        return $this->render(
                "RIWebServicesBundle:Test:RITestCombos3.html.twig",
                array(
                    'form' =>$form->createView()
                ));
        
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

                $render = $this->renderRedireccionarTestWS(
                        $form,
                        RIFormularios::TEST_WS_FORM_CAMAS);
                
                if ($render!=null){
                    
                    return $render;
                }

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

                return $this->renderRedireccionarTestWS(
                        $form,
                        RIFormularios::TEST_WS_FORM_HABITACIONES);

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

                return $this->renderRedireccionarTestWS(
                        $form,
                        RIFormularios::TEST_WS_FORM_SALAS);

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
