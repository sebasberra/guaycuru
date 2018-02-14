<?php
/** 
 * Controlador de la Configuración Edilicia 
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 */

namespace RI\RIWebServicesBundle\Controller\ConfiguracionEdilicia;


use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use RI\RIWebServicesBundle\Utils\Render\Render;

/**
 * Controlador de la Configuración Edilicia
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 */
class ConfiguracionEdiliciaController extends Controller
{
    
    use Render;
    
    /**
    * Action URI de acceso al organigrama de la configuración edilicia
    * 
    * @param Request $request Petición HTML
    * 
    * @Route("/organigrama")
    */
    public function organigramaAction(Request $request)
    {
        
        $config_edilicia = array();
        $config_orgchart = array();
        
        try {

            $this->get('app.configuracion_edilicia');
            
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\ConfiguracionEdilicia\ConfiguracionEdiliciaType');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {


                
                $param = $form->getData();
                
                $id_efector = 
                        $param['efectores']->getIdEfector();
           
                $config_edilicia = RIUtiles::getSalasHabCamasChoices($id_efector);
                
                $config_orgchart = array(
                    
                    'direccion'                 => $param['direccion'],
                    'zoom'                      => $param['zoom'],
                    'pan'                       => $param['pan'],
                    'profundidad'               => $param['profundidad'],
                    'export_file_extension'     => $param['export_file_extension']
                        
                    );
                
            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion organigramaAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar el organigrama de la configuración edilicia del efector', 
                    $msg);

        }
    
        return $this->render(
                'RIWebServicesBundle:ConfiguracionEdilicia:config_edilicia_organigrama.html.twig',
                array(
                    'form' =>$form->createView(),
                    'config_edilicia' => $config_edilicia,
                    'config_orgchart' => $config_orgchart
                ));
    }
    
}
