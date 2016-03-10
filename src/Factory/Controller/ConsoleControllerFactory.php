<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace Is\Bernard\Factory\Controller;

use Bernard\Consumer;
use Is\Bernard\Controller\ConsoleController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ConsoleControllerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):ConsoleController
    {
        $consumer = $serviceLocator->get(Consumer::class);

        return new ConsoleController($consumer);
    }
}
