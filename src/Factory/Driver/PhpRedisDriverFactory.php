<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Driver;

use Bernard\Driver\PhpRedisDriver;
use InteractiveSolutions\Bernard\BernardOptions;
use Interop\Container\ContainerInterface;
use Redis;
use Zend\ServiceManager\ServiceLocatorInterface;

class PhpRedisDriverFactory
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):PhpRedisDriver
    {
        return $this->build($serviceLocator);
    }

    public function __invoke(ContainerInterface $container)
    {
        return $this->build($container);
    }

    /**
     * Build the object
     *
     * @param ServiceLocatorInterface|ContainerInterface $container
     *
     * @return PhpRedisDriver
     */
    private function build($container):PhpRedisDriver
    {
        /* @var $options BernardOptions */
        $options = $container->get(BernardOptions::class);

        /* @var $instance Redis */
        $instance = $container->get($options->getRedisInstanceKey());

        return new PhpRedisDriver($instance);
    }
}
