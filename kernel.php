<?php


use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpFoundation\Response;
use \Symfony\Component\HttpKernel\Kernel;

$loader = require __DIR__. "/vendor/autoload.php";

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader([$loader,'loadClass']);

/**
 * Kernel da Aplicação
 */

 class AppKernel extends Kernel
 {
    use MicroKernelTrait;

    public function registerBundles()
    {
        $bundles = [
            new FrameworkBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
        ];

        if ($this->getEnvironment() == 'dev')
        {
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }
        
        return $bundles;
    }

    protected function configureContainer(\Symfony\Component\DependencyInjection\ContainerBuilder $c, LoaderInterface $loader)
    {

       $loader->load(__DIR__."/config/config.yml");

       if (isset($this->bundles['WebProfilerBundle']))
       {
            $c->loadFromExtension('web_profiler', [
                'toolbar' => true,
                'intercept_redirects' => false
            ]);
       }
       
    }

    protected function configureRoutes(\Symfony\Component\Routing\RouteCollectionBuilder $routes)
    {
        $routes->mount('/', $routes->import(__DIR__. '/src/App/Controller/', 'annotation'));

        if (isset($this->bundles['WebProfilerBundle']))
        {
            $routes->mount('/_wdt', $routes->import('@WebProfilerBundle/Resources/config/routing/wdt.xml'));
            $routes->mount('/_profiler', $routes->import('@WebProfilerBundle/Resources/config/routing/profiler.xml'));
        }

    }

    
 }
 
