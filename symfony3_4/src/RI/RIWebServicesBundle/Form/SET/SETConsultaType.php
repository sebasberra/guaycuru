<?php

// src/AppBundle/Form/Type/SportMeetupType.php
namespace RI\RIWebServicesBundle\Form\SET;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormInterface;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;




class SETConsultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $efectores = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Efectores')
                        ->findByConfiguracionesSistemas();

        
        $builder
            ->add(
                    'efectores', 
                    EntityType::class, 
                    array(
                        'class'       => RIUtiles::DB_BUNDLE.':Efectores',
                        'placeholder' => '',
                        'choices'     => $efectores,
                        'label'       => 'Efector',
                        'required'    => false,
                        'group_by' => function($efector, $key, $index) {
                            
                            switch ($efector->getIdNodo()){

                                case 1:

                                    return 'RECONQUISTA';

                                case 2:

                                    return 'RAFAELA';

                                case 3:

                                    return 'SANTA FE';

                                case 4:

                                    return 'ROSARIO';

                                case 5:

                                    return 'VENADO TUERTO';

                                default:

                                    return 'NO DEFINIDO';
                         
                            }
                        }
                    )
            )
            ->add(
                    'salas',
                    EntityType::class, 
                    array(
                        'class'       => RIUtiles::DB_BUNDLE.':Salas',
                        'placeholder' => '',
                        'choices'     => array(),
                        'label'       => 'Salas:',
                        'required'    => false
                    )
            )
            ->add(
                    'habitaciones',
                    EntityType::class, 
                    array(
                        'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                        'placeholder' => '',
                        'choices'     => array(),
                        'label'       => 'Habitaciones:',
                        'required'    => false
                    )
            )
            ->add(
                    'tipos_cuidados_progresivos', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Cuidado Progresivo:',
                        'choices' => array(
                            'TODOS' => '-1',
                            'MODERADO' => '0',
                            'INTERMEDIO' => '1',
                            'CRITICO' => '2'
                        ),
                        'data'  => '-1'
                    )
                )
            ->add(
                    'categorias_edades', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Edad:',
                        'choices' => array(
                            'TODAS' => '-1',
                            'ADULTO' => 'ADU',
                            'PEDIATRICA' => 'PED',
                            'NEONATOLOGIA' => 'NEO'
                        ),
                        'data'  => '-1'
                    )
                )
            ->add(
                    'estado', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Estado: ',
                        'choices' => array(
                            'TODOS' => '-1',
                            'LIBRE' => 'L',
                            'OCUPADA' => 'O',
                            'FUERA DE SERVICIO' => 'F',
                            'EN REPARACION' => 'R',
                            'RESERVADA' => 'V'                            
                        ),
                        'data'  => 'L'
                    
                    )
                )
            ->add(
                    'bt_ver', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Ver'
                    )
            )
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                array($this, 'onPreSubmit')
                );
    }
    
    
    //
    // NOTA: despues del POST por boton submit no se activan los listener de
    // JavaScript
    //
    public function onPreSubmit(FormEvent $event)
    {
        
        
        // ini form y data
        $form = $event->getForm();
        $data = $event->getData();
        
        //
        // data
        // 
        
        // efector 
        $id_efector = $data['efectores'];

        // sala
        $id_sala = $data['salas'];
        
        // salas
        if ($id_efector==''){
            
            $salas = array();
            
        }else{
            
        
            $salas = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Salas')
                        ->findByIdEfector($id_efector);
        }

        $form->add(
                'salas',
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':Salas',
                    'placeholder' => '',
                    'choices'     => $salas,
                    'label'       => 'Salas:',
                    'required'    => false
                )
        );
        
        
        
        // habitaciones
        if ($id_sala==''){
            
            $habitaciones = array();
            
        }else{
            
            $habitaciones = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Habitaciones')
                        ->findByIdSala($id_sala);
        }
        
        // 
        $form->add(
                'habitaciones',
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                    'placeholder' => '',
                    'choices'     => $habitaciones,
                    'label'       => 'Habitaciones:',
                    'required'    => false
                )
        );
       
        
    }
       
}
