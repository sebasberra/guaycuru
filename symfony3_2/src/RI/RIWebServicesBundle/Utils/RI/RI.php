<?php

namespace RI\RIWebServicesBundle\Utils\RI;


/** Clase abstracta RI que extienden las clases del 
 *  proyecto que no heredan de alguna clase symfony
 * 
 */
abstract class RI
{
    
    public static $error_debug;
    
    public static $doctrine;
    public static $conn;
    
    public static $form_factory;
    
    public static $user;
    
    public static $validator;
    
    public function __construct(
            $doctrine,
            $form_factory,
            $security_token,
            $validator) {
    
        self::$doctrine = $doctrine;
        self::$conn = $doctrine->getManager('default')->getConnection();
        self::$error_debug = '';
        self::$form_factory = $form_factory;
        self::$user = $security_token->getToken()->getUser();
        self::$validator = $validator;
        
    }
    
    
    public function __destruct() {
    
        
    }
    
    
}