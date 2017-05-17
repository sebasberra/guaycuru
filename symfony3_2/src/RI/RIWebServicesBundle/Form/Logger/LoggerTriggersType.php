<?php

namespace RI\RIWebServicesBundle\Form\Logger;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use RI\RIWebServicesBundlevicesBundle\Utils\RI\RI;


class LoggerTriggersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

//        !!! pasar al controller y meter en $options
//        // columnas
//        $consulta = 
//                "SELECT " 
//                    ."t.TABLE_NAME "
//                ."FROM "
//                    ."INFORMATION_SCHEMA.TABLES t "
//                ."WHERE "
//                    ."t.TABLE_SCHEMA = :table_schema "
//                ."AND t.TABLE_NAME NOT LIKE 'logs%'";
//        
//        $stmt = RI::$conn->prepare($consulta);
//            
//        $stmt->bindValue("table_schema", $this->getParameter('database_name'));
                
//        try {
//        
//            // ejecuta consulta
//            $stmt->execute();
//            $tablas = $stmt->fetchAll();
//                        
//        } catch (\Exception $e) {
//
//            $msg = "Error al consultar las tablas de la base";
//                    
//            RI::$error_debug .= $msg.$e->getMessage();
//
//            throw $e;
//        }
        
        $builder
            ->add(
                    'tabla', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Tabla:',
                        'choices' => $tablas
                    )
                )
            ->add(
                    'generar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType', 
                    array(
                        'label' => 'Crear Script'
                        )
                    );
                
        
    }
    
    
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}

