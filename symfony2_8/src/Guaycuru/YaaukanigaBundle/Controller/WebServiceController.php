<?php

namespace Guaycuru\YaaukanigaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class WebServiceController extends Controller
{
    /**
     * @Soap\Method("hello")
     * @Soap\Param("name", phpType = "string")
     * @Soap\Result(phpType = "string")
     */
    public function helloAction($name)
    {
        return sprintf('Hello %s!', $name);
    }

    /**
     * @Soap\Method("goodbye")
     * @Soap\Param("name", phpType = "string")
     * @Soap\Result(phpType = "string")
     */
    public function goodbyeAction($name)
    {
        return $this->container->get('besimple.soap.response')->setReturnValue(sprintf('Goodbye %s!', $name));
    }
}

