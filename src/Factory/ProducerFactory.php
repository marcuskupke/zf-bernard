<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory;

use Bernard\QueueFactory;
use InteractiveSolutions\Bernard\BernardOptions;
use InteractiveSolutions\Bernard\EventDispatcherInterface;
use InteractiveSolutions\Bernard\Producer;
use Interop\Container\ContainerInterface;

class ProducerFactory
{
    public function __invoke(ContainerInterface $container): Producer
    {
        /* @var $options BernardOptions */
        $options = $container->get(BernardOptions::class);

        /* @var $queue QueueFactory */
        $queue = $container->get($options->getQueueInstanceKey());

        /* @var $dispatcher EventDispatcherInterface */
        $dispatcher = $container->get(EventDispatcherInterface::class);

        return new Producer($queue, $dispatcher);
    }
}
