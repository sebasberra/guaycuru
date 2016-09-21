<?php

//include __DIR__.'/../vendor/stg/theme-bundle/STG/DEIM/Themes/Bundles/AplicativoBundle/ThemeAplicativoBundle.php';
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        
               
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new Guaycuru\YaaukanigaBundle\YaaukanigaBundle(),
            new Guaycuru\QiluazusBundle\QiluazusBundle(),
            new Guaycuru\TemburesBundle\TemburesBundle(),
            new STG\DEIM\Themes\Bundles\AplicativoBundle\ThemeAplicativoBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Guaycuru\DBHmi2Bundle\DBHmi2Bundle(),
            new Guaycuru\SeguridadBundle\SeguridadBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
