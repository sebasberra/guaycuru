<?php

// src/AppBundle/Form/Type/SportMeetupType.php
namespace RI\RIWebServicesBundle\Form\Test;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormInterface;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;




class TestCombos2Type extends AbstractType
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
                        'required'    => true,
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
                        'required'    => false
                    )
            )
            ->add(
                    'camas', 
                    EntityType::class, 
                    array(
                        'class'       => RIUtiles::DB_BUNDLE.':Camas',
                        'placeholder' => '',
                        'choices'     => array(),
                        'required'    => false
                    )
            )
            ->add(
                    'bt_probar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Probar'
                    )
            )
            ->addEventListener(
                FormEvents::PRE_SUBMIT,
                array($this, 'onPreSubmit')
                );
    }
    
    
    
    public function onPreSubmit(FormEvent $event)
    {
        
        $form = $event->getForm();
        $data = $event->getData();
        
        // efector 
        $id_efector = $data['efectores'];

        // carga salas
        $salas = null === $id_efector ? array() : 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Salas')
                        ->findByIdEfector($id_efector);
        

        $form->add(
                'salas', 
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':Salas',
                    'placeholder' => '',
                    'choices'     => $salas,
                    'required'    => false
                )
            );
        
        
        // sala
        $id_sala = $data['salas'];
        
        // carga habitaciones
        $habitaciones = null === $id_sala ? array() : 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Habitaciones')
                        ->findByIdSala($id_sala);
        
        $form->add(
                'habitaciones', 
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                    'placeholder' => '',
                    'choices'     => $habitaciones,
                    'required'    => false
                )
            );
        
        
        // habitacion
        $id_habitacion = $data['habitaciones'];
        
        // carga camas
        $camas = null === $id_habitacion ? array() : 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Camas')
                        ->findByIdHabitacion($id_habitacion);
        
        $form->add(
                'camas', 
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':Camas',
                    'placeholder' => '',
                    'choices'     => $camas,
                    'required'    => false
                )
            );
        
//        dump($data);
        
    }
       
}
