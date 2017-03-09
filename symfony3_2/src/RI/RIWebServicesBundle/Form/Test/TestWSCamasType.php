<?php

namespace RI\RIWebServicesBundle\Form\Test;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        
        
        
        $builder
            ->add(
                    'clasificaciones_camas', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Clasificación',
                        'class' => 'DBHmi2GuaycuruCamasBundle:ClasificacionesCamas',
                        'query_builder' => function (EntityRepository $er) {
                            
                            $qb = $er
                                    ->createQueryBuilder('cc');    
                            
                            return $qb;
                        },
                        'choice_label' => 'ClasificacionCama'
                    )
            )
            ->add(
                    'efectores', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Efector',
                        'class' => 'DBHmi2GuaycuruCamasBundle:Efectores',
                        'query_builder' => function (EntityRepository $er) {
                            
                            $qb = $er
                                    ->createQueryBuilder('e')
                                    ->where('e.idEfector = 72');    
                            
                            return $qb;
                        },
                        'choice_label' => 'NomEfector'
                    )
            )
            ->add(
                    'habitaciones', 
                    'Symfony\Bridge\Doctrine\Form\Type\EntityType',
                    array(
                        'label' => 'Habitacion',
                        'class' => 'DBHmi2GuaycuruCamasBundle:Habitaciones',
                        'query_builder' => function (EntityRepository $er) {
                            
                            $qb = $er
                                    ->createQueryBuilder('h')
                                    ->where('h.idSala = 72001');    
                            
                            return $qb;
                        },
                        'choice_label' => 'Nombre'
                    )
            )
            ->add(
                    'nombre', 
                    'Symfony\Component\Form\Extension\Core\Type\TextType',
                    array(
                        'attr' => 
                            array(
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
                            'Libre' => 'L',
                            'Ocupada' => 'O',
                            'Fuera de servicio' => 'F',
                            'En Reparación' => 'R',
                            'Reservada' => 'V'
                        ),
                        'attr' => array(
                            'placeholder' => 'Estado'
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
                        
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}