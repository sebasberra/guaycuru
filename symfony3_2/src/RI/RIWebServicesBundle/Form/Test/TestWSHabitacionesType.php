<?php

namespace RI\RIWebServicesBundle\Form\Test;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
class TestWSHabitacionesType extends AbstractType
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
                        'required'    => true
                    )
            )
            ->add(
                    'nombre', 
                    TextType::class, 
                    array(
                        'label'=> 'Nombre: ',
                        'attr' => array(
                            'placeholder' => 'Nombre de la habitación'
                        ),
                        'required'    => true
                    )
            )
            // sexo: 1=hombres; 2=mujeres; 3=mixto
            ->add(
                    'sexo', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Sexo: ',
                        'choices' => array(
                            'Hombres' => '1',
                            'Mujeres' => '2',
                            'Mixto' => '3'
                        ),
                        'attr' => array(
                            'placeholder' => 'Sexo admitido en la habitación'
                        ),
                        'required'    => true
                    )
                )
            ->add(
                    'tipo_edad', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Tipo de Edad: ',
                        'choices' => array(
                            'Años' => 1,
                            'Meses' => 2,
                            'Días' => 3,
                            'Horas' => 4,
                            'Minutos' => 5,
                            'Se Ignora' => 6
                        ),
                        'attr' => array(
                            'placeholder' => 'Tipo de edad admitido en la habitación'
                        ),
                        'required'    => true
                    )
                )
            ->add(
                    'edad_desde', 
                    IntegerType::class, 
                    array(
                        'label'=> 'Edad Desde: ',
                        'required'    => true
                    )
            )
            ->add(
                    'edad_hasta', 
                    IntegerType::class, 
                    array(
                        'label'=> 'Edad Hasta: ',
                        'required'    => true
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
                        ),
                        'required'    => true
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
            )->add(
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
            
            $salas = array();
        }else{
            
        
            $salas = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Salas')
                        ->findByIdEfector($id_efector);
        }
        
        // salas
        $form->add(
                    'salas',
                    EntityType::class, 
                    array(
                        'class'       => RIUtiles::DB_BUNDLE.':Salas',
                        'placeholder' => '',
                        'choices'     => $salas,
                        'label'       => 'Salas:',
                        'required'    => true
                    )
            );
        
    }
        
    
    public function configureOptions(OptionsResolver $resolver)
    {

    }
}
