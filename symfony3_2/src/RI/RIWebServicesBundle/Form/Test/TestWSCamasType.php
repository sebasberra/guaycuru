<?php

namespace RI\RIWebServicesBundle\Form\Test;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use RI\DBHmi2GuaycuruCamasBundle\Entity\Efectores;



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
        

        // choices habitaciones
        $hab_choices = RIUtiles::getSalasHabitacionesChoices(72);
        
        // choices camas
        $camas_choices = RIUtiles::getSalasHabCamasChoices(72);
        
//        dump($camas_choices);die();
        
        $builder
            ->add(
                    'id_clasificacion_cama', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Clasificación',
                        'class' => RIUtiles::DB_BUNDLE.':ClasificacionesCamas',
                        'query_builder' => function (EntityRepository $er) {
                            
                            $qb = $er
                                    ->createQueryBuilder('cc')
                                    ->orderBy('cc.tipoCuidadoProgresivo', 'ASC');
                            
                            return $qb;
                        },
                        'choice_label' => 'clasificacionCama',
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
                    'id_efector', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Efector',
                        'class' => RIUtiles::DB_BUNDLE.':Efectores',
                        'query_builder' => function (EntityRepository $er) {
                            
                            $qb = $er
                                    ->createQueryBuilder('e')
                                    ->where('e.idEfector = 72 or e.idEfector=121');    
                            
                            return $qb;
                        },
                        'choice_label' => 'nomEfector'
                    )
            )
//            ->addEventListener(
//                FormEvents::PRE_SET_DATA,
//                function (FormEvent $event) {
//                
//                    $form = $event->getForm();
//
//                    // 
//                    $data = $event->getData();
//
//                    if ($data == null){
//                        
//                        return array(); 
//                    }
//                                        
//                    $efector = $data->getIdEfector();
//                    
//                    $id_efector = $efector->getIdEfector();
//                    
//                    $habitaciones = 
//                        RI::$em
//                        ->getRepository(RIUtiles::DB_BUNDLE.':Habitaciones')
//                        ->findByIdEfector($id_efector);
//                    
//                    $form->add('id_habitacion', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', array(
//                        'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
//                        'placeholder' => '',
//                        'choices'     => $habitaciones,
//                        'choice_label' => 'nombre',
//                        'group_by' => function($habitaciones, $key, $index) {
//                            
//                            return $habitaciones->getIdSala()->getNombre();
//                        }
//                        
//                    ));
//                }
//                
//            )
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
            );
            
        
            
        $formModifier = function (FormInterface $form, Efectores $efector = null) {
            
            

            $id_efector = $efector->getIdEfector();

            $habitaciones = 
                RI::$em
                ->getRepository(RIUtiles::DB_BUNDLE.':Habitaciones')
                ->findByIdEfector($id_efector);

            $form->add('id_habitacion', 'Symfony\Bridge\Doctrine\Form\Type\EntityType', array(
                'class'       => RIUtiles::DB_BUNDLE.':Habitaciones',
                'placeholder' => '',
                'choices'     => $habitaciones,
                'choice_label' => 'nombre',
                'group_by' => function($habitaciones, $key, $index) {

                    return $habitaciones->getIdSala()->getNombre();
                }

            ));
            
        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                // this would be your entity, i.e. SportMeetup
                $data = $event->getData();
                
                if ($data == null){

                    return array(); 
                }

                $formModifier($event->getForm(), $data->getIdEfector());
            }
        );

        $builder->get('id_efector')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                // It's important here to fetch $event->getForm()->getData(), as
                // $event->getData() will get you the client data (that is, the ID)
                $efector = $event->getForm()->getData();

                // since we've added the listener to the child, we'll have to pass on
                // the parent to the callback functions!
                $formModifier($event->getForm()->getParent(), $efector);
            }
        );
        
                        
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'RI\DBHmi2GuaycuruCamasBundle\Entity\Camas'
        ));
    }
}