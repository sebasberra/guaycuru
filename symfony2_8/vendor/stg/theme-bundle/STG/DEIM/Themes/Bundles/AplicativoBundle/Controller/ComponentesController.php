<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComponentesController extends Controller
{
    
    /*
     * public function indexAction() { return $this->render('ThemeAplicativoBundle:Default:index_maqueta_completa.html.twig'); }
     */
    public function tabsAction()
    {
        return $this->render('ThemeAplicativoBundle:Componentes:tabs.html.twig');
    }
}
