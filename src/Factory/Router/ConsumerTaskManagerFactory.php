<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Router;

use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsumerTaskManagerFactory implements FactoryInterface
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
        /* @var $config array */
        $config = $serviceLocator->get('config');
        $config = $config['interactive_solutions']['bernard_consumer_manager'];

        return new ConsumerTaskManager(new Config($config));
    }
}
