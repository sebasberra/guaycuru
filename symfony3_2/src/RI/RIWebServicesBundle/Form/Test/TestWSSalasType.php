<?php

namespace RI\RIWebServicesBundle\Form\Test;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;



/** 
 * WebServices testing
 * 
 *  Agregar cama
 *  ------------
 * 
 *   ["nombre_cama"]
 *   ["nombre_habitacion"]
 *   ["id_efector"]
 *   ["id_clasificacion_cama"]
 *   ["estado"]
 *   ["rotativa"]
 *   ["baja"]
 * 
 * 
 *  Baja
 *  ----
 * 
 *  id_clasificacion_cama
 *  id_habitacion
 *  baja
 *  estado
 * 
 *
 */
class TestWSCamasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        
        // efectores configuraciones sistemas
        $efectores = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Efectores')
                        ->findByConfiguracionesSistemas();
        
        // clasificaciones camas
        $clasificaciones_camas = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':ClasificacionesCamas')
                        ->findAll();
        
        $builder
            ->add(
                    'efectores', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Efector: ',
                        'placeholder' => '',
                        'class' => RIUtiles::DB_BUNDLE.':Efectores',
                        'choices' => $efectores,
                        'choice_label' => 'nomEfector',
                        'group_by' => function($efector, $key, $index) {
                            
                            return ('Región: '.$efector->getNodo());
                        }
                    )
            )
            ->add(
                    'sala',
                    TextType::class, 
                    array(
                        'label'       => 'Sala:',
                        'required'    => false,
                        'data'        => '',
                        'attr' => array(
                            'placeholder' => 'Debe seleccionar una habitación de la lista',
                            'readonly'    => 'readonly'
                            )
                    )
            )
            ->add(
                    'habitaciones', 
                    EntityType::class, 
                    array(
                        'label'       => "Habitaciones: ",
                        'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                        'placeholder' => '',
                        'choices'     => array(),
                    )
            )
            ->add(
                    'clasificaciones_camas', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Clasificación: ',
                        'class' => RIUtiles::DB_BUNDLE.':ClasificacionesCamas',
                        'choice_label' => 'clasificacionCama',
                        'choices' => $clasificaciones_camas,
                        'group_by' => function($clasificacion_cama, $key, $index) {
                            
                            switch ($clasificacion_cama->getTipoCuidadoProgresivo()){
                                
                                case 0:
                                    return('Cuidado Moderado');
                                
                                case 1:
                                    return('Cuidado Intermedio');
                                    
                                case 2:
                                    return('Cuidado Intensivo');
                                    
                            }
                        }
                    )
            )
            ->add(
                    'nombre', 
                    'Symfony\Component\Form\Extension\Core\Type\TextType',
                    array(
                        'label'=> 'Nombre: ',
                        'attr' => array(
                            'placeholder' => 'Nombre de la cama'
                            )
                        )
                    )
            // Estado: L=libre; O=ocupada; F=fuera de servicio; R=en reparacion; V=reservada
            ->add(
                    'estado', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Estado: ',
                        'choices' => array(
                            'Libre' => 'L',
                            'Ocupada' => 'O',
                            'Fuera de servicio' => 'F',
                            'En Reparación' => 'R',
                            'Reservada' => 'V'
                        )
                    )
                )
            ->add(
                    'rotativa', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => '¿ Es rotativa ?',
                        'choices' => array(
                            'Si' => 1,
                            'No' => 0
                        ),
                        'attr' => array(
                            'placeholder' => 'Rotativa'
                        )
                    )
                )
            ->add(
                    'baja', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => '¿ Está dada de baja ?',
                        'choices' => array(
                            'Si' => 1,
                            'No' => 0
                        ),
                        'attr' => array(
                            'placeholder' => 'Baja'
                        )
                    )
                )
            ->add(
                    'bt_agregar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Agregar'
                    )
            )
            ->add(
                    'bt_modificar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Modificar'
                    )
            )
            ->add(
                    'bt_eliminar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Eliminar'
                    )
            )
            ->add(
                    'bt_liberar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Liberar'
                    )
            )
            ->add(
                    'bt_ocupar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Ocupar'
                    )
            )
            ->add(
                    'bt_baja', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Baja'
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
        // ini form y data
        $form = $event->getForm();
        $data = $event->getData();
        
        //
        // data
        // 
        
        // efector 
        $id_efector = $data['efectores'];

        // id_habitacion
        $id_habitacion = $data['habitaciones'];
        
        
        // habitaciones
        if ($id_efector==''){
            
            $habitaciones = array();
        }else{
            
        
            $habitaciones = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Habitaciones')
                        ->findByIdEfector($id_efector);
        }
        
        // habitaciones
        $form->add(
                'habitaciones', 
                EntityType::class, 
                array(
                    'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                    'placeholder' => '',
                    'choices'     => $habitaciones,
                    'required'    => false,
                    'group_by' => function($habitacion, $key, $index) {

                        return ($habitacion->getIdSala()->getNombre());
                    }
                )
            );
                
        // POST id_habitacion
        if ($id_habitacion != ''){
            
            
            $habitacion =
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Habitaciones')
                        ->findByIdHabitacion($id_habitacion);
            
            
            $form->add(
                    'sala',
                    TextType::class, 
                    array(
                        'label'       => 'Sala:',
                        'required'    => false,
//                        'data'        => $habitacion[0]->getIdSala()->getNombre(),
                        'attr' => array(
                            'placeholder' => 'Debe seleccionar una habitación de la lista',
                            'value'       => $habitacion[0]->getIdSala()->getNombre(),
                            'readonly'    => 'readonly'
                            )
                    )
            );
            
        }
        
        
        
        
    }
        
    
    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
