<?php

namespace RI\RIWebServicesBundle\Form\Logger;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class LoggerConsultaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                    'buscar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType', 
                    array(
                        'label' => 'Buscar'
                        )
                    );
                
        
    }
    
    
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}

