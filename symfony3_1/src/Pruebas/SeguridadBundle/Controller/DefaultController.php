<?php

namespace Pruebas\SeguridadBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
    * @Route("/autenticar/{usuario}/{id_efector}/{sicaptoken}", name="login_user")
    */
    public function autenticarAction(
            $usuario,
            $id_efector,
            $sicaptoken)
    {
        
        
        // check usuario loggeado
        if (!$this->get('security.authorization_checker')->
                isGranted('IS_AUTHENTICATED_FULLY')) {
            
        
            /* token de verificacion: 
            * 
            *  {fecha_hoy ( date("dmY") )usuario+id_efector+fecha_hoy ( date("Ymd") ) } md5
            * 
            * opciones de seguridad:
            * 
            * ver si usar method post o get
            * y pasar id de sesion para encriptar
            * 
            * se puede inventar un token por base de datos 
            * 
            * ver si existe una consulta con relacion al usuario que sea
            * particular de la sesion
            * 
            * ver servidor de fecha/hora get fecha hora del 
            * mysql de sicap. ver si el link desde sicap llama a un php
            * y ese php genera el token y redirecciona
            *
            */
            $sftoken=$this->encriptarToken($usuario,$id_efector);
            
            if ($sftoken!=$sicaptoken){
                throw $this->createAccessDeniedException();
            }
            
        }
            
        
        // request 
        $request = $this->get('request_stack')->getCurrentRequest();
        
        // session
        $request->getSession()->set('usuario',$usuario);
        
        // nuevo user token symfony
        $token = new UsernamePasswordToken($usuario, null, 'main', array("ROLE_USER"));
	$this->get('security.token_storage')->setToken($token);
         
        // response
        return $this->redirectToRoute('user');
        
    }
    
        
    /** logout a pata
     * 
     * @Route("/logout", name="logoutUser")
     */
    public function logoutAction()
    {
        // esta seria la funcion de logout
        $request = $this->get('request_stack')->getCurrentRequest();
        $this->get('security.token_storage')->setToken(null);
        $request->getSession()->invalidate();
                
        
        // aca estaria el menu del sicap
        
        // redirect externally
        return $this->redirect('http://localhost:8002/');
    }
    
    
    /** formula que genera el token
     * 
     * @param type $usuario
     * @param type $id_efector
     * @return type
     */
    private function encriptarToken($usuario,$id_efector){
        
        /* Para añadir mas seguridad se puede 
         * pasar por POST el id sesion PHP
         * del servidor de SICAP
         */
        $fecha1 = date('Ymd');
        $fecha2 = date('dmY');
        
        $token = md5($fecha1.$usuario.$id_efector.$fecha2);
        
        return $token;
    }
    
    
    /**
    * @Route("/user", name="user")
    */
    public function userAction(){
        
        return $this->render('SeguridadBundle:Default:user.html.twig');
    }
    
    /**
    * @Route("/admin")
    */
    public function adminAction()
    {
        
        return $this->render('SeguridadBundle:Default:admin.html.twig');
    }
    
    
    
    /** ruteado desde routing.yml de SeguridadBundle 
     * 
     * solo para testing porque el login seria desde otro lado
     * 
     * @return type
     */
    public function loginAction()
    {
        
        // genera el url para login
        $url = $this->generateUrl(
            'login_user',
            array(
                'usuario' => 'sebas',
                'id_efector' => '72',
                'sicaptoken' => $this->encriptarToken('sebas','72')
                )
        );
        
        
        // response
        return $this->render(
                'SeguridadBundle:Default:login.html.twig',
                array(
                    'url'=>$url
                )
            );
    }
}
