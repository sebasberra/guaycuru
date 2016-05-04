<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{

    /**
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        
        // $this->generateUrl('/aplicativo/');
        $path = $this->generateUrl('theme_aplicativo_homepage');
        
        $componentes =

        '<a href="//www.santafe.gov.ar/assets">www.santafe.gov.ar/assets: Repositorio.</a><br>' .           
            
        '<a href="' . $path . 'tabla">Tabla.html.twig: vista de tabla de registros.</a><br>' . 

        '<a href="' . $path . 'breadcrumb">breadcrumb.html.twig: define la ruta de navegación del sistema.</a><br>' . 

        '<a href="' . $path . 'selectTable">selectTable.html.twig: define una vista de selección múltiple.</a><br>' . 

        '<a href="' . $path . 'acordion">acordion.html.twig: define una vista estilo acordion para su reutilización</a><br>' . 

        '<a href="' . $path . 'tabs">tabs.html.twig: define una vista de pestañas para su reutilización.</a><br>' . 

        '<a href="' . $path . 'ayuda">ayuda.html.twig: define una vista para ayuda general del sistema de tipo acordiones.</a><br>';
        
        return $this->render('ThemeAplicativoBundle:Default:index_maqueta_completa.html.twig', array(
            'componente' => 'Aplicación demo de componentes disponibles: <br>' . $componentes
        ));
    }

    /**
     *
     * @param unknown $component            
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function componentAction($component)
    {
        /*
         * switch ($component) { case 'ayuda': $vista = $this->renderView('ThemeAplicativoBundle:Componentes:' . $component . '.html.twig', array( 'options' => array( 'Solicitud' => 'asdasdasdsad asdasd asliasd laksjd', 'Servicios' => 'dflgkjdfg lkdjfg dflgkjdfg', 'Perfiles' => 'dflgkjdfg lkdjfg dflgkjdfg' ) )); break; case 'acordion': $vista = $this->renderView('ThemeAplicativoBundle:Componentes:' . $component . '.html.twig', array( 'options' => array( 'Titulo' => 'asdasdasdsad asdasd asliasd laksjd aslkdjaqsd lkajsd asdlkj asdlkjasd', 'Titulo2' => 'dffdgfdgdfgdf dflgkjdfg lkdjfg dflgkjdfg lkjdfg', 'Titulo3' => 'dffdgfdgdfgdf dflgkjdfg lkdjfg dflgkjdfg lkjdfg' ) )); break; case 'tabs': $vista = $this->renderView('ThemeAplicativoBundle:Componentes:' . $component . '.html.twig', array( 'titleOptions' => array( '#tab1' => 'Titulo1111', '#tab2' => 'Titulo2222', '#tab3' => 'Titulo3333' ), 'option' => array( 'tab1' => 'asdasdasdsad asdasd asliasd laksjd aslkdjaqsd lkajsd asdlkj asdlkjasd', 'tab2' => 'dffdgfdgdfgdf dflgkjdfg lkdjfg dflgkjdfg lkjdfg', 'tab3' => 'dffdgfdgdfgdf dflgkjdfg lkdjfg dflgkjdfg 32121212311' ) )); break; default: // según parametro tomo el componente $vista = $this->renderView('ThemeAplicativoBundle:Componentes:' . $component . '.html.twig'); break; }
         */
        $vista = $this->renderView('ThemeAplicativoBundle:Componentes:' . $component . '.html.twig');
        
        return $this->render('ThemeAplicativoBundle:Default:index_maqueta_completa.html.twig', array(
            'componente' => $vista
        ));
    }
}
