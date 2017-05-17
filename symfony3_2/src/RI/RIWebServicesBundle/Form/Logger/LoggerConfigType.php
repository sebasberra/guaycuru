<?php

namespace RI\RIWebServicesBundle\Form\Logger;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LoggerConfigType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'activar', 
                    'Symfony\Component\Form\Extension\Core\Type\CheckboxType', 
                    array(
                        'label'    => 'Activar logger ?',
                        'required' => true
                        )
                    )
            ->add(
                    'guardar_modificaciones_nulas', 
                    'Symfony\Component\Form\Extension\Core\Type\CheckboxType', 
                    array(
                        'label'    => 'Guardar modificaciones nulas ?',
                        'required' => true
                        )
                    )
            ->add(
                    'guardar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType', 
                    array(
                        'label' => 'Guardar'
                        )
                    );
                
        
    }
    
    
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}

