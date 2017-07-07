<?php
/**
 * Controlador para el anexo del sistema de SET
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 */
namespace RI\RIWebServicesBundle\Controller\SET;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use RI\RIWebServicesBundle\Utils\Render\Render;


/**
 * Controlador para el anexo del sistema de SET
 * 
 * @author Sebastián Berra sebasberra@yahoo.com.ar
 */
class SETController extends Controller
{
    
    use Render;
    
    /**
     * Action URI de formulario de consulta de camas libres
     * 
     * @param Request $request
     * 
     * @Route("/consulta")
     */
    public function consultaAction(Request $request)
    {
        
        $camas = array();
        
        try {

            $this->get('app.ri_formularios');
            
            
            // form
            $form = RI::$form_factory->create(
                    'RI\RIWebServicesBundle\Form\SET\SETConsultaType');
            

            $form->handleRequest($request);
            
            // check submit
            if ($form->isSubmitted() && 
                    $form->isValid()) {


                
                $param = $form->getData();
                
                $tipo_cuidado_progresivo = $param['tipos_cuidados_progresivos'];
                
                $categoria_edad = $param['categorias_edades'];
                
                $estado = $param['estado'];
                
                $id_efector = 
                        null === $param['efectores'] ? 
                        '-1' : 
                        $param['efectores']->getIdEfector();
                    
                $id_sala = 
                        null === $param['salas'] ? 
                        '-1' : 
                        $param['salas']->getIdSala();
                
                $id_habitacion = 
                        null === $param['habitaciones'] ? 
                        '-1' : 
                        $param['habitaciones']->getIdHabitacion();
                
                $camas =
                        RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Camas')
                        ->findByConsultaSET(
                                $tipo_cuidado_progresivo,
                                $categoria_edad,
                                $estado,
                                $id_efector,
                                $id_sala,
                                $id_habitacion);
                
            }

        }catch(\Exception $e){
            
            $msg = 'Desconocido';
            
            RI::$error_debug .= 
                    "Funcion consultaAction: "
                    .$e->getMessage();
            
            return $this->renderException(
                    'Error al cargar la página de consulta de camas', 
                    $msg);

        }
    
        return $this->render(
                'RIWebServicesBundle:SET:setconsulta.html.twig',
                array(
                    'form' =>$form->createView(),
                    'camas' =>$camas
                ));
        
    }
}
