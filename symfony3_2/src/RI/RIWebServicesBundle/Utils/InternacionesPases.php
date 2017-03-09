<?php

namespace RI\RIWebServicesBundle\Utils;

class InternacionesPases
{

    private $conn;
    
    public function __construct($doctrine) {
    
        $this->conn = $doctrine->getManager('default')->getConnection();
        
    }
    
    public function __destruct() {
    
        
    }

}

