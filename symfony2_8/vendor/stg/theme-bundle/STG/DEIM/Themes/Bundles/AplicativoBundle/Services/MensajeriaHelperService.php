<?php
namespace STG\DEIM\Themes\Bundles\AplicativoBundle\Services;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Translation\Translator;

class MensajeriaHelperService
{

    protected $session;
    protected $translator;

    public function __construct(Session $session, $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    public function setMensajeFlashError($idMensaje, $bundle = '')
    {
        $this->session->getFlashBag()->add('error', array(
            'titulo' => $this->obtenerMensajeTraducido('Title.Error', $bundle),
            'mensaje' => $this->obtenerMensajeTraducido($idMensaje, $bundle),
            'tipo' => 2
        ));
    }

    public function setMensajeFlashExito($idMensaje, $bundle = '')
    {
        $this->session->getFlashBag()->add('success', array(
            'titulo' => $this->obtenerMensajeTraducido('Title.Success', $bundle),
            'mensaje' => $this->obtenerMensajeTraducido($idMensaje, $bundle),
            'tipo' => 1
        ));
    }
    
    
    public function setMensajeFlash($stringMensaje)
    {
        $this->session->getFlashBag()->add('success', array(
            'titulo' => $this->obtenerMensajeTraducido('Mensaje', ''),
            'mensaje' => $this->obtenerMensajeTraducido($stringMensaje, ''),
            'tipo' => 1
        ));
    }

    private function obtenerMensajeTraducido($idMensaje, $bundle)
    {
        return $this->translator->trans($idMensaje, array(), $bundle);
    }
}
