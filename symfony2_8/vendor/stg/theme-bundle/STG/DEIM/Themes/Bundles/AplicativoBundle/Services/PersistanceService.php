<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

use Doctrine\ORM\EntityManager;

class PersistanceService
{

    protected $em;
    protected $mensajeria_helper;
    protected $custom_logger;
    protected $exception_handler;

    public function __construct(EntityManager $em, MensajeriaHelperService $mensajeria_helper, CustomLoggerService $custom_logger, ExceptionHandlerService $exception_handler)
    {
        $this->em = $em;
        $this->mensajeria_helper = $mensajeria_helper;
        $this->custom_logger = $custom_logger;
        $this->exception_handler = $exception_handler;
    }

    public function persistFlushEntityAndFlashMessage($entidad, $prefijoClaveMensaje = '', $bundleMensaje = '')
    {
        try {
            $this->em->persist($entidad);
            $this->em->flush();
            
            $this->mensajeria_helper->setMensajeFlashExito($prefijoClaveMensaje . '.Success', $bundleMensaje);
        } catch (\Exception $ex) {
            
            $this->exception_handler->handleUpdateException($ex, 'Form.Perfil');
        }
    }

    public function removeFlushEntityAndFlashMessage($entidad, $prefijoClaveMensaje = '', $bundleMensaje = '')
    {
        try {
            $this->em->persist($entidad);
            $this->em->flush();
            
            $this->mensajeria_helper->setMensajeFlashExito($prefijoClaveMensaje . '.Success', $bundleMensaje);
        } catch (\Exception $ex) {
            
            $this->exception_handler->handleUpdateException($ex, 'Form.Perfil');
        }
    }
    
    public function persistFlushEntity($entidad)
    {
        $this->em->persist($entidad);
        $this->em->flush();
    }
    
    public function removeFlushEntity($entidad)
    {
        $this->em->remove($entidad);
        $this->em->flush();
    }
}
