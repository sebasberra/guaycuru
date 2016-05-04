<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\HttpFoundation\Session\Session;

class UtilService
{

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function generarJSON($entidad, $ignorar = array())
    {
        $normalizer = new GetSetMethodNormalizer();
        $normalizer->setIgnoredAttributes($ignorar);
        $serializer = new Serializer(array(
            $normalizer
        ), array(
            'json' => new JsonEncoder()
        ));
        return $serializer->serialize($entidad, 'json');
    }

    /**
     * 
     * @param array $resultArray
     * @param array $mapkey
     * @return json
     */
    public function generarJSONJqueryUI(array $resultArray, array $mapkey)
    {
        $salida = array();
        
        foreach ($resultArray as $data) {
            $fila = array();
            foreach ($mapkey as $key => $value) {
                $fila[$key] = $data[$value];
            }
            $salida[] = $fila;
        }
        
        return json_encode($salida);
    }
}
