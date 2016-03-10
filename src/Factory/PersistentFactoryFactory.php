<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace Is\Bernard\Factory;

use Bernard\Driver;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PersistentFactoryFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):PersistentFactory
    {
        /* @var $driver Driver */
        $driver = $serviceLocator->get(Driver::class);

        /* @var $serializer Serializer */
        $serializer = $serviceLocator->get(Serializer::class);

        return new PersistentFactory($driver, $serializer);
    }
}
