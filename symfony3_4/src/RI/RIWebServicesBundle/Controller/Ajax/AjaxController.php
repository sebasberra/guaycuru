<?php
 
namespace RI\RIWebServicesBundle\Controller\Ajax;
 
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


use RI\RIWebServicesBundle\Utils\RI\RI;


class AjaxController extends Controller
{
   
    use AjaxArrays,
        AjaxOrgCharts;
    /**
     * @Route("/logger/foreignkey", name="ajax_logger_foreignkey")
     * @Method({"GET"})
     */
    public function loggerForeignkeyAction(Request $request)
    {

        $queryString = split('&',$request->getQueryString());
        
        $campo = split('=',$queryString[0])[1];
        $tabla = split('=',$queryString[1])[1];
        $valor = split('=',$queryString[2])[1];
        
        
        // inicializa response vacio
        $ajson = array();
        $datos_json=json_encode($ajson);
                
        
        if($request->isXmlHttpRequest()){
        
            $this->get('app.ri_utiles');
            
            // columnas
            $consulta = 
                    "SELECT "
                        ."iu.REFERENCED_TABLE_NAME, "
                        ."iu.REFERENCED_COLUMN_NAME "
                    ."FROM "
                        ."INFORMATION_SCHEMA.KEY_COLUMN_USAGE iu "
                    ."WHERE "
                        ."iu.REFERENCED_TABLE_SCHEMA = :referenced_table_schema "
                    ."AND iu.TABLE_NAME = :table_name "
                    ."AND iu.COLUMN_NAME = :column_name ";
                        

            $stmt = RI::$conn->prepare($consulta);
            
            $stmt->bindValue("referenced_table_schema", $this->getParameter('database_name'));
            $stmt->bindValue("table_name", $tabla);
            $stmt->bindValue("column_name", $campo);
            
            // ejecuta consulta
            $stmt->execute();
            $tabla_columna = $stmt->fetchAll();
            
            if ($tabla_columna){
            
                $ref_tabla = $tabla_columna[0]['REFERENCED_TABLE_NAME'];
                $ref_columna = $tabla_columna[0]['REFERENCED_COLUMN_NAME'];
                
                $consulta =
                        "SELECT "
                            ."t.* "
                        ."FROM "
                            .$ref_tabla." t "
                        ."WHERE "
                            ."t.".$ref_columna." = :id_tabla";
                
                
                $stmt = RI::$conn->prepare($consulta);
                $stmt->bindValue("id_tabla", $valor);
                
                // ejecuta consulta
                $stmt->execute();
                
                $datos = $stmt->fetchAll();
                
                $datos[1] = $ref_tabla;
                $datos[2] = $ref_columna;
                
                $datos_json = $this
                        ->container
                        ->get('serializer')
                        ->serialize($datos, 'json');

            }
            
        }
        
        $response = new Response($datos_json,200);
        
        return $response;
        
    }
    
}

