<?php

namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Listener;

use STG\DEIM\Themes\Bundles\AplicativoBundle\Services\ExceptionHandlerService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\Routing\Router;

class ExceptionListener
{

    protected $session;
    protected $router;
    protected $request;
    protected $exceptionHandler;

    public function __construct(Session $session, Router $router, Request $request,  ExceptionHandlerService $exceptionHandler)
    {
        $this->session = $session;
        $this->router = $router;
        $this->request = $request;
        $this->exceptionHandler = $exceptionHandler;
    }

    public function onAccessDeniedException(GetResponseForExceptionEvent $event)
    {
        if ($event->getException() instanceof AccessDeniedHttpException) {
            
            $this->exceptionHandler->handleAccesDeniedExceptionException($event->getException());

            if ($this->request->headers->get('referer')) {
                $route = $this->request->headers->get('referer');
            } else {
                $route = $this->router->generate('login');
            }

            $event->setResponse(new RedirectResponse($route));
        }
    }

}
