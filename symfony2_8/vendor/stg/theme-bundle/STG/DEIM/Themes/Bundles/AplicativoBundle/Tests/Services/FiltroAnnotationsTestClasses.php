<?php

namespace STG\DEIM\Auditoria\Bundles\AuditoriaBundle\Tests\Services;

use JMS\Serializer\Annotation\Type;
use STG\DEIM\Themes\Bundles\AplicativoBundle\Annotation\Filter;

/**
 * FiltrableClass
 */
class FiltrableClass
{

    /**
     * @Type("string")
     * @Filter(type="text")
     */
    public $atributoText = 'texto';

    
    /**
     * @Type("string")
     * @Filter(type="si_no")
     */
    public $atributoSiNo = false;
    
    /**
     * @Type("string")
     */
    public $atributoNoFiltrable = 'NoFiltrable';
}
