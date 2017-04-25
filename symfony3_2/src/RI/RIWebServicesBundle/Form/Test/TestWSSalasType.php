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
class TestWSSalasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        
        // efectores configuraciones sistemas
        $efectores = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Efectores')
                        ->findByConfiguracionesSistemas();
        
        
        
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
                    'nombre', 
                    'Symfony\Component\Form\Extension\Core\Type\TextType',
                    array(
                        'label'=> 'Nombre: ',
                        'attr' => array(
                            'placeholder' => 'Nombre de la Sala'
                            )
                        )
                    )
            ->add(
                    'efectores_servicios', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Area: ',
                        'placeholder' => '',
                        'class' => RIUtiles::DB_BUNDLE.':EfectoresServicios',
                        'choices' => array(),
                        'choice_label' => 'nomServicioEstadistica',
                        'required' => false
                    )
            )
            ->add(
                    'mover_camas', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Permite Mover Camas',
                        'choices' => array(
                            'Si' => 1,
                            'No' => 0
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

        
        // habitaciones
        if ($id_efector==''){
            
            $efectores_servicios = array();
            
        }else{
            
        
            $efectores_servicios = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':EfectoresServicios')
                        ->findByIdEfectorInternacion($id_efector);
        }
        
        // efectores_servicios
        $form
                ->add(
                    'efectores_servicios', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Area: ',
                        'placeholder' => '',
                        'class' => RIUtiles::DB_BUNDLE.':EfectoresServicios',
                        'choices' => $efectores_servicios,
                        'choice_label' => 'nomServicioEstadistica',
                        'required' => false
                    )
            );
                
        
    }
        
    
    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
