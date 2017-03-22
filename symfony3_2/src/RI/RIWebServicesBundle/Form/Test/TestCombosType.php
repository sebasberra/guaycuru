<?php

// src/AppBundle/Form/Type/SportMeetupType.php
namespace RI\RIWebServicesBundle\Form\Test;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormInterface;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;

use RI\DBHmi2GuaycuruCamasBundle\Entity\Efectores;


class TestCombosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $efectores = 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Efectores')
                        ->findByConfiguracionesSistemas();
        
        $builder
            ->add('efectores', EntityType::class, array(
                'class'       => RIUtiles::DB_BUNDLE.':Efectores',
                'placeholder' => '',
                'choices'     => $efectores
                )
            );
            

        
        $formModifier = function (FormInterface $form, Efectores $efector = null) {
            
            $salas = null === $efector ? array() : 
                    RI::$doctrine->getRepository
                        (RIUtiles::DB_BUNDLE.':Salas')
                        ->findByIdEfector($efector->getIdEfector());

            $form->add('salas', EntityType::class, array(
                'class'       => RIUtiles::DB_BUNDLE.':Salas',
                'placeholder' => '',
                'choices'     => $salas,
                'required'    => false
                )
            )
            ->add(
                'probar', 
                'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                array(
                    'label' => 'Probar'
                )
            );

        };

        
        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {
                
                $formModifier($event->getForm(), null);
                
            }
        );

        $builder->get('efectores')->addEventListener(
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

    
}
