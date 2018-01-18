<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Router;

use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

final class ConsumerTaskManagerFactory
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     *
     * @return ConsumerTaskManager
     */
    public function __invoke(ContainerInterface $container): ConsumerTaskManager
    {
        /* @var $config array */
        $config = $container->get('config');
        $config = $config['interactive_solutions']['bernard_consumer_manager'];

        return new ConsumerTaskManager($container, $config);
    }
}
