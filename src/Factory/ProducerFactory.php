<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory;

use Bernard\Middleware\MiddlewareBuilder;
use Bernard\Producer;
use Bernard\Queue;
use InteractiveSolutions\Bernard\BernardOptions;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ProducerFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):Producer
    {
        return $this->build($serviceLocator);
    }

    public function __invoke(ContainerInterface $container):Producer
    {
        return $this->build($container);
    }

    /**
     * @param ServiceLocatorInterface|ContainerInterface $container
     *
     * @return Producer
     */
    private function build($container):Producer
    {
        /* @var $options BernardOptions */
        $options = $container->get(BernardOptions::class);

        /* @var $queue Queue */
        $queue = $container->get($options->getQueueInstanceKey());

        /* @var $middleware MiddlewareBuilder */
        $middleware = $container->get(MiddlewareBuilder::class);

        return new Producer($queue, $middleware);
    }
}
