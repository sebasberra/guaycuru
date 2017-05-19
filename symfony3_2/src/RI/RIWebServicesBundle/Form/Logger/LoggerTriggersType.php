<?php

namespace RI\RIWebServicesBundle\Form\Logger;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class LoggerTriggersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        
//        $tablas=array_values($options['data']);
//        dump(count($options['data']));
        $tablas=array();
        foreach($options['data'] as $tabla){
            
            $tablas[$tabla['TABLE_NAME']]=$tabla['TABLE_NAME']; 
        }

        $builder
            ->add(
                    'tabla', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Tabla:',
                        'choices' => $tablas
                    )
                )
            ->add(
                    'generar', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType', 
                    array(
                        'label' => 'Crear Script'
                        )
                    );
                
        
    }
    
    
    public function configureOptions(OptionsResolver $resolver)
    {
        
    }
}

