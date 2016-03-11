<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory;

use Bernard\Consumer;
use Bernard\Middleware\MiddlewareBuilder;
use InteractiveSolutions\Bernard\Router\PluginManagerRouter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsumerFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $router PluginManagerRouter */
        $router = $serviceLocator->get(PluginManagerRouter::class);

        /* @var $middleware MiddlewareBuilder */
        $middleware = $serviceLocator->get(MiddlewareBuilder::class);

        return new Consumer($router, $middleware);
    }
}
