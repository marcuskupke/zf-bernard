<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory;

use Bernard\Consumer;
use InteractiveSolutions\Bernard\EventDispatcherInterface;
use InteractiveSolutions\Bernard\Router\PluginManagerRouter;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsumerFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return Consumer
     */
    public function __invoke(ServiceLocatorInterface $serviceLocator): Consumer
    {
        /* @var $router PluginManagerRouter */
        $router = $serviceLocator->get(PluginManagerRouter::class);

        /* @var $dispatcher EventDispatcherInterface */
        $dispatcher = $serviceLocator->get(EventDispatcherInterface::class);

        return new Consumer($router, $dispatcher);
    }
}
