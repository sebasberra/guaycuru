<?php

namespace RI\RIWebServicesBundle\Form\Test;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;

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
                        'label' => 'Efector',
                        'class' => RIUtiles::DB_BUNDLE.':Efectores',
                        'choices' => $efectores,
                        'choice_label' => 'nomEfector',
                        'group_by' => function($efector, $key, $index) {
                            
                            return ('Región: '.$efector->getNodo());
                        }
                    )
            )
            ->add(
                    'salas', EntityType::class, array(
                    'class'       => RIUtiles::DB_BUNDLE.':Salas',
                    'placeholder' => '',
                    'choices'     => array(),
                    'required'    => false
                    )
            )
            ->add(
                    'habitaciones', EntityType::class, array(
                    'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                    'placeholder' => '',
                    'choices'     => array(),
                    'required'    => false
                    )
            )
            ->add(
                    'clasificaciones_camas', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Clasificación',
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
                        },
                    )
            )
            ->add(
                    'nombre', 
                    'Symfony\Component\Form\Extension\Core\Type\TextType',
                    array(
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
                        
                        'choices' => array(
                            'Seleccione el estado de la cama' => '',
                            'Libre' => 'L',
                            'Ocupada' => 'O',
                            'Fuera de servicio' => 'F',
                            'En Reparación' => 'R',
                            'Reservada' => 'V'
                        ),
                        'constraints' => array(
                            new NotBlank(),
                        )
                    )
                )
            ->add(
                    'rotativa', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
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
                )
            ->addEventListener(
                FormEvents::POST_SUBMIT,
                array($this, 'onPostSubmit')
                )
                
                ;
        
    }
    
    
    
    public function onPostSubmit(FormEvent $event)
    {
        
        $data = $event->getData();
        dump($data);die();
    }                
    public function onPreSubmit(FormEvent $event)
    {
        $data = $event->getData();
        
        $id_efector = $data['efectores'];
        $salas = null === $id_efector ? array() : 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Salas')
                        ->findByIdEfector($id_efector);
        $form = $event->getForm();

        $form->add(
                    'salas', EntityType::class, array(
                    'class'       => RIUtiles::DB_BUNDLE.':Salas',
                    'placeholder' => '',
                    'choices'     => $salas,
                    'required'    => false
                    )
            );
        
        $id_sala = $data['salas'];
        $habitaciones = null === $id_sala ? array() : 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Habitaciones')
                        ->findByIdSala($id_sala);
        
        $form->add(
                    'habitaciones', EntityType::class, array(
                    'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                    'placeholder' => '',
                    'choices'     => $habitaciones,
                    'required'    => false
                    )
            );
        
        dump($data);
        
    }
    
   
    public function configureOptions(OptionsResolver $resolver)
    {
//        $resolver->setDefaults(array(
//            'data_class' => 'RI\DBHmi2GuaycuruCamasBundle\Entity\Camas'
//        ));
    }
}