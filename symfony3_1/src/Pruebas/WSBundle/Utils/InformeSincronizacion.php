<?php

namespace Pruebas\WSBundle\Utils;

class InformeSincronizacion
{

    private $conn;
    
    public function __construct($doctrine) {
    
        $this->conn = $doctrine->getManager('default')->getConnection();
        
    }
    
    public function __destruct() {
    
        
    }

}
