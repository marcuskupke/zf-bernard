<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Serializer;

use Bernard\JMSSerializer\EnvelopeHandler;
use Bernard\Serializer\JMSSerializer;
use Interop\Container\ContainerInterface;
use JMS\Serializer\Handler\HandlerRegistry;
use JMS\Serializer\SerializerBuilder;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class JMSSerializerFactory implements FactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(ServiceLocatorInterface $serviceLocator):JMSSerializer
    {
        return $this->build($serviceLocator);
    }

    public function __invoke(ContainerInterface $container):JMSSerializer
    {
        return $this->build($container);
    }

    private function build($container):JMSSerializer
    {
        $serializer = SerializerBuilder::create()
            ->configureHandlers(function (HandlerRegistry $registry) {
                $registry->registerSubscribingHandler(new EnvelopeHandler());
            })
            ->build();

        return new JMSSerializer($serializer);
    }
}
