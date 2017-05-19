<?php

namespace RI\RIWebServicesBundle\Form\Logger;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;


class LoggerConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $length = new Length(
                array (
                    'max' => 255,
                    'maxMessage' => 'La descripción no puede superar los 255 caracteres'
                    )
                );
        
        $builder
            ->add(
                    'descripcion', 
                    'Symfony\Component\Form\Extension\Core\Type\TextType', 
                    array(
                        'label'    => 'Descripción:',
                        'required' => false,
                        'constraints' => $length)
                    )
            ->add(
                    'estado', 
                    'Symfony\Component\Form\Extension\Core\Type\CheckboxType', 
                    array(
                        'label'    => 'Logger Activo ?',
                        'required' => false
                        )
                    )
            ->add(
                    'guardar_modificaciones_nulas', 
                    'Symfony\Component\Form\Extension\Core\Type\CheckboxType', 
                    array(
                        'label'    => 'Guardar modificaciones nulas ?',
                        'required' => false
                        )
                    )
            ->add(
                    'guardar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType', 
                    array(
                        'label' => 'Guardar'
                        )
                    )
            ->add(
                    'vaciar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType', 
                    array(
                        'label' => 'Vaciar Logger'
                        )
                    )
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
                );
                
        
    }
    
    
    public function onPreSetData(FormEvent $event)
    {
        
        // logs auditados
        $consulta = 
                "SELECT "
                    ."la.id_log_auditado,"
                    ."la.descripcion, "
                    ."la.estado, "
                    ."la.guardar_modificaciones_nulas "
                ."FROM "
                    ."logs_auditados la "
                ."LIMIT 0,1";

        try{
            
            $stmt = RI::$conn->prepare($consulta);
            
            // ejecuta consulta
            $stmt->execute();
            $logs_auditados = $stmt->fetchAll();
            
        } catch (\Exception $e) {
            
            RI::$error_debug .= ' Función onPreSetData en LoggerConfigType';
            
            throw $e;

        }
        
        foreach($logs_auditados as $log_auditado){
            
            $data['descripcion'] = $log_auditado['descripcion'];
            $data['estado'] = 
                    RIUtiles::wrapBoolean($log_auditado['estado']);
            $data['guardar_modificaciones_nulas'] = 
                    RIUtiles::wrapBoolean($log_auditado['guardar_modificaciones_nulas']);
//            dump($log_auditado);
//            dump($data);die();
        }
        
        $event->setData($data);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}

