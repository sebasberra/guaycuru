<?php

namespace STG\DEIM\Auditoria\Bundles\AplicativoBundle\Tests\Services;

use STG\DEIM\Auditoria\Bundles\AuditoriaBundle\Tests\Services\FiltrableClass;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of FiltroServiceTest
 *
 * @author fbaroni@santafe.gov.ar
 */
class FiltroServiceTest extends WebTestCase
{
//
//    /**
//     * @var RequestService
//     */
//    private $requestService;
//
//    /**
//     * @var
//     */
//    private $container;
//
//    /**
//     * {@inheritDoc}
//     */
//    public function setUp()
//    {
//        $container = $this->getContainer();
//        $container->enterScope('request');
//        $request = Request::create('/t/1/');
//        $session = $this->getMock('Symfony\Component\HttpFoundation\Session\SessionInterface');
//        $request->setSession($session);
//        $this->getContainer()->set('request', $request);
//
//        $this->requestService = $this->container->get('request');
//    }
//
//    /**
//     * {@inheritDoc}
//     */
//    public function tearDown()
//    {
//        $this->getContainer()->leaveScope('request');
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getContainer()
//    {
//        if ($this->container) {
//            return $this->container;
//        }
//
//        static::$kernel = static::createKernel();
//        static::$kernel->boot();
//
//        $this->container = static::$kernel->getContainer();
//
//        return $this->container;
//    }
//
//    public function testIsFiltrableAttributeTest()
//    {
//        $this->client = static::createClient();
//        $container = $this->client->getContainer();
//
//        $this->client->request('GET', '/adminWidget/solicitudes/');
//
//        $filtroService = $container->get('stg.deim.themes.aplicativo.filtro');
//
//        $filtrableObject = new FiltrableClass();
//
//        $filtros = $filtroService->getFiltros(new FiltrableClass());
//    }

}
