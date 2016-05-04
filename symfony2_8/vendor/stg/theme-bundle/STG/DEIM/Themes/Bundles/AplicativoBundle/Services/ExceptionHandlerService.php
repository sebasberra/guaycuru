<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class ExceptionHandlerService
{

    protected $custom_logger;
    protected $mensajeria_helper;

    public function __construct(CustomLoggerService $custom_logger, MensajeriaHelperService $mensajeria_helper)
    {
        $this->custom_logger = $custom_logger;
        $this->mensajeria_helper = $mensajeria_helper;
    }

    public function handleControllerRemoveException(\Exception $ex, $preMessageKey, $bundle = '')
    {
        $this->custom_logger->logControllerException($ex);
        if ($ex instanceof \Doctrine\DBAL\DBALException && $ex->getPrevious() && $ex->getPrevious()->getCode() == 23000) {
            
            $this->mensajeria_helper->setMensajeFlashError($preMessageKey . '.RemoveEnUso', $bundle);
        } else {
            $this->mensajeria_helper->setMensajeFlashError($preMessageKey . '.RemoveError', $bundle);
        }
    }

    public function handleControllerUpdateException(\Exception $ex, $preMessageKey, $bundle = '')
    {
        $this->custom_logger->logControllerException($ex);
        
        $this->mensajeria_helper->setMensajeFlashError($preMessageKey . '.Error', $bundle);
    }

    public function handleUpdateException(\Exception $ex, $preMessageKey, $bundle = '')
    {
        $this->custom_logger->logControllerException($ex);
        
        $this->mensajeria_helper->setMensajeFlashError($preMessageKey . '.Error', $bundle);
    }

    public function handleRemoveException(\Exception $ex, $preMessageKey, $bundle = '')
    {
        $this->custom_logger->logControllerException($ex);
        if ($ex instanceof \Doctrine\DBAL\DBALException && $ex->getPrevious() && $ex->getPrevious()->getCode() == 23000) {
            
            $this->mensajeria_helper->setMensajeFlashError($preMessageKey . '.RemoveEnUso', $bundle);
        } else {
            $this->mensajeria_helper->setMensajeFlashError($preMessageKey . '.RemoveError', $bundle);
        }
    }
    
    public function handleAccesDeniedExceptionException(AccessDeniedHttpException $ex)
    {
        $this->custom_logger->logControllerException($ex);
        $this->mensajeria_helper->setMensajeFlashError('No posee los permisos necesarios para acceder a esta sección.');
    }
}
