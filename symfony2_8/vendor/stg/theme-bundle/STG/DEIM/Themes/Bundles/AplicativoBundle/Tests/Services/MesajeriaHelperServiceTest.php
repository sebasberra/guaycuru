<?php

namespace STG\DEIM\Auditoria\Bundles\AplicativoBundle\Tests\Services;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of MensajeriaHelperServiceTest
 *
 * @author fbaroni@santafe.gov.ar
 */
class MesajeriaHelperServiceTest extends WebTestCase
{

    protected static $mensajeriaHelper;
    protected static $session;
    protected static $container;

    public static function setUpBeforeClass()
    {
        $kernel = static::createKernel();
        $kernel->boot();

        self::$container = $kernel->getContainer();
        self::$mensajeriaHelper = self::$container->get('stg.deim.themes.aplicativo.mensajeria_helper');
        self::$session = self::$container->get('session');
    }

    public function testSetMensajesYObtener()
    {
        $mensajePrueba = 'Probando';
        self::$mensajeriaHelper->setMensajeFlash($mensajePrueba);

        $flashSuccess = self::$session->getFlashBag()->get('success');
        $this->assertEquals($flashSuccess[0]['mensaje'], $mensajePrueba);
        
        $flashSuccessAfterGet = self::$session->getFlashBag()->get('success');        
        $this->assertFalse(isset($flashSuccessAfterGet[0]));
    }

    public function testSetMensajesErrorYObtener()
    {
        $mensajePrueba = 'Bundle.Clave';
        self::$mensajeriaHelper->setMensajeFlashError($mensajePrueba, 'bundle');

        $flashError = self::$session->getFlashBag()->get('error');
        $this->assertEquals($flashError[0]['mensaje'], $mensajePrueba);
        
        $flashErrorAfterGet = self::$session->getFlashBag()->get('error');        
        $this->assertFalse(isset($flashErrorAfterGet[0]));
    }

    public function testSetMensajesExitoYObtener()
    {
        $mensajePrueba = 'Bundle.Clave';
        self::$mensajeriaHelper->setMensajeFlashExito($mensajePrueba, 'bundle');

        $flashSuccess = self::$session->getFlashBag()->get('success');
        $this->assertEquals($flashSuccess[0]['mensaje'], $mensajePrueba);
        
        $flashSuccessAfterGet = self::$session->getFlashBag()->get('success');        
        $this->assertFalse(isset($flashSuccessAfterGet[0]));
    }

}