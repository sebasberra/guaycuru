<?php

// src/AppBundle/Form/Type/SportMeetupType.php
namespace RI\RIWebServicesBundle\Form\Test;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormInterface;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;




class TestCombos3Type extends AbstractType
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
                    'sala', 
                    TextType::class, 
                    array(
                        'label'       => 'Sala:',
                        'disabled'    => true,
                        'data'        => 'Seleccione la Sala desde el listado de Servicios',
                        'required'    => false
                    )
            )
            ->add(
                    'servicios_salas', 
                    EntityType::class, 
                    array(
                        'class'       => RIUtiles::DB_BUNDLE.':ServiciosSalas',
                        'placeholder' => '',
                        'choices'     => array(),
                        'label'       => 'Servicio:',
                        'required'    => false
                    )
            )
            ->add(
                    'habitacion', 
                    TextType::class, 
                    array(
                        'label'       => 'Habitación:',
                        'disabled'    => true,
                        'data'        => 'Seleccione la Habitación desde el listado de Camas',
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
                        'label'       => 'Cama:',
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

        // id_servicio_sala
        $id_servicio_sala = $data['servicios_salas'];
        
        // id_cama
        $id_cama = $data['camas'];
        
        
        // servicios salas
        $servicios_salas = null === $id_efector ? array() : 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':ServiciosSalas')
                        ->findByIdEfector($id_efector);
        

        $form->add(
                'servicios_salas', 
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':ServiciosSalas',
                    'placeholder' => '',
                    'choices'     => $servicios_salas,
                    'label'       => 'Servicio:',
                    'required'    => false,
                    'group_by' => function($servicio_sala, $key, $index) {

                        return ($servicio_sala->getIdSala()->getNombre());
                    }
                )
            );
        
        
        
        // POST id_servicio_sala
        if ($id_servicio_sala == ''){
            
            
            $camas = array();
            
            
                        
        }else{
        
            $sala = RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Salas')
                        ->findByIdServicioSala($id_servicio_sala);
            
            // sala
            $form->add(
                    'sala', 
                    TextType::class, 
                    array(
                        'label'       => 'Sala:',
                        'disabled'    => true,
                        'data'        => $sala->getNombre(),
                        'required'    => false
                    )
            );
            
            // carga camas
            $camas = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Camas')
                        ->findByIdSala($sala->getIdSala());
            
            
        }
        
        // POST id_cama
        if ($id_cama!=''){
            
            $habitacion = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Habitaciones')
                        ->findByIdCama($id_cama);
            $form->add(
                    'habitacion', 
                    TextType::class, 
                    array(
                        'label'       => 'Habitación:',
                        'disabled'    => true,
                        'data'        => $habitacion->getNombre(),
                        'required'    => false
                    )
            );
        }
        
        // refresh camas
        $form->add(
                'camas', 
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':Camas',
                    'placeholder' => '',
                    'choices'     => $camas,
                    'label'       => 'Cama:',
                    'required'    => false,
                    'group_by' => function($cama, $key, $index) {

                        return ($cama->getIdHabitacion()->getNombre());
                    }
                )
            );
        
        
        
    }
       
}
