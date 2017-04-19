<?php


namespace RI\RIWebServicesBundle\Form\ConfiguracionEdilicia;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use RI\RIWebServicesBundle\Utils\RI\RI;
use RI\RIWebServicesBundle\Utils\RI\RIUtiles;




class ConfiguracionEdiliciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
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
                        'required'    => true,
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
                    'direccion', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Dirección:',
                        'choices' => array(
                            'DEFAULT' => 't2b',
                            'IZQUIERDA A DERECHA' => 'l2r',
                            'ABAJO HACIA ARRIBA' => 'b2t',
                            'DERECHA A IZQUIERDA' => 'r2l'
                        ),
                        'data'  => '-1'
                    )
                )
            ->add(
                    'zoom', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Zoom:',
                        'choices' => array(
                            'NO' => 'false',
                            'SI' => 'true'
                        ),
                        'data'  => 'false'
                    )
                )
            ->add(
                    'pan', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Pan:',
                        'choices' => array(
                            'NO' => 'false',
                            'SI' => 'true'
                        ),
                        'data'  => 'false'
                    )
                )
            ->add(
                    'profundidad', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Profundidad:',
                        'choices' => array(
                            'DEFAULT' => 'false',
                            'VERTICAL' => 'true'
                        ),
                        'data'  => 'false'
                    )
                )
            ->add(
                    'export_file_extension', 
                    'Symfony\Component\Form\Extension\Core\Type\ChoiceType',
                    array(
                        'label'   => 'Formato de Exportación:',
                        'choices' => array(
                            'DESACTIVADO' => 'false',
                            'IMAGEN (PNG)' => 'png',
                            'PDF' => 'pdf'
                        ),
                        'data'  => 'false'
                    )
                )
            ->add(
                    'bt_ver', 
                    'Symfony\Component\Form\Extension\Core\Type\SubmitType',
                    array(
                        'label' => 'Ver'
                    )
            );
    }
    
       
}
