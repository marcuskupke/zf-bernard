<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory;

use InteractiveSolutions\Bernard\BernardOptions;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BernardOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):BernardOptions
    {
        return $this->build($serviceLocator);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null):BernardOptions
    {
        return $this->build($container);
    }

    /**
     * @param ServiceLocatorInterface|ContainerInterface $container
     *
     * @return BernardOptions
     */
    private function build($container):BernardOptions
    {
        /* @var $config array */
        $config = $container->get('config');
        $config = $config['interactive_solutions']['options'][BernardOptions::class] ?? [];

        return new BernardOptions($config);
    }
}
