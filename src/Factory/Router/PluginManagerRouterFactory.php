<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Router;

use InteractiveSolutions\Bernard\PluginManagerRouter;
use InteractiveSolutions\Bernard\Router\ConsumerPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PluginManagerRouterFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):PluginManagerRouter
    {
        /* @var $consumerPluginManager ConsumerPluginManager */
        $consumerPluginManager = $serviceLocator->get(ConsumerPluginManager::class);

        return new PluginManagerRouter($consumerPluginManager);
    }
}