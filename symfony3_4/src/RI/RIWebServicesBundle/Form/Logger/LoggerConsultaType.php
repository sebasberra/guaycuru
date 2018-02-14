<?php

namespace RI\RIWebServicesBundle\Form\Logger;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LoggerConsultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        dump($options['data']);die();
        
        $tablas=array();
        foreach($options['data'][0] as $tabla){
            
            $tablas[$tabla['tabla']]=$tabla['tabla']; 
        }
        
        $users_db=array();
        foreach($options['data'][1] as $user_db){
            
            $users_db[$user_db['user_db']]=$user_db['user_db']; 
        }
        
        $hosts_db=array();
        foreach($options['data'][2] as $host_db){
            
            $hosts_db[$host_db['host_db']]=$host_db['host_db']; 
        }
        
        $builder
            ->add(
                    'tablas', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Tablas:',
                        'choices' => $tablas,
                        'multiple' => false,
                        'expanded' => true,
                        'required' => false,
                        'placeholder' => 'Todas'
                        )
                    )
            ->add(
                    'user_db', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Usuario DB:',
                        'choices' => $users_db,
                        'multiple' => false,
                        'expanded' => true,
                        'required' => false,
                        'placeholder' => 'Todos'
                        )
                    )
            ->add(
                    'host_db', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Host DB:',
                        'choices' => $hosts_db,
                        'multiple' => false,
                        'expanded' => true,
                        'required' => false,
                        'placeholder' => 'Todas'
                        )
                    )
            ->add(
                    'descripcion', 
                    'Symfony\Component\Form\Extension\Core\Type\TextType',
                    array(
                        'label'   => 'Descripción:',
                        'required' => false
                        )
                    )
            ->add(
                    'fecha_desde', 
                    'Symfony\Component\Form\Extension\Core\Type\DateType',
                    array(
                        'label' => 'Fecha Desde:',
                        'widget' => 'single_text',
                        'format' => 'dd/MM/yyyy',
                        'html5' => false,
                        'attr' => ['class' => 'campo_fecha'],
                        'input' => 'string',
                        'invalid_message' => 'Fecha incorrecta',
                        'required' => false
                    )
            )
            ->add(
                    'fecha_hasta', 
                    'Symfony\Component\Form\Extension\Core\Type\DateType',
                    array(
                        'label' => 'Fecha Hasta:',
                        'widget' => 'single_text',
                        'format' => 'dd/MM/yyyy',
                        'html5' => false,
                        'attr' => ['class' => 'campo_fecha'],
                        'input' => 'string',
                        'invalid_message' => 'Fecha incorrecta',
                        'required' => false
                    )
            )
            ->add(
                    'order_fecha', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Orden Fecha:',
                        'choices' => array('DESC'=>'DESC','ASC'=>'ASC'),
                        'required' => true
                        )
                    )
            ->add(
                    'buscar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType', 
                    array(
                        'label' => 'Buscar'
                        )
                    );
                
        
    }
    
    
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}

