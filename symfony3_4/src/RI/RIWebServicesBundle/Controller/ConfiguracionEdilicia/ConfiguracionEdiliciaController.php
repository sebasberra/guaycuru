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
                    
                    /* The available values are 
                     * t2b(implies "top to bottom", it's default value), 
                     * b2t(implies "bottom to top"), 
                     * l2r(implies "left to right"), 
                     * r2l(implies "right to left"). */
                    'direccion'                 => 't2b',
                    'zoom'                      => $param['zoom'],
                    'pan'                       => $param['pan'],
                    'verticalLevel'               => 5,
                    'export_file_extension'     => 'false'
                        
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
