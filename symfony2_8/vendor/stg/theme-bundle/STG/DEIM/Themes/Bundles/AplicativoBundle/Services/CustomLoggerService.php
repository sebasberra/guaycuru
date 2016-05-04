<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

class CustomLoggerService
{

    protected $logger;
    protected $request;
    protected $router;

    public function __construct($logger, $request, $router)
    {
        $this->logger = $logger;
        $this->request = $request;
        $this->router = $router;
    }

    public function logControllerException($exception)
    {
        $this->logger->error(sprintf('%s : { %s (Codigo de excepción = %s) }', $this->request->get('_route'), $exception->getMessage(), $exception->getCode()));
    }
}
