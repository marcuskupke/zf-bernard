<?php
/**
 * @copyright Interactive Solutions
 */

declare(strict_types=1);

namespace InteractiveSolutions\Bernard;

use Bernard\Consumer;
use Bernard\Driver\PhpRedisDriver;
use Bernard\Normalizer\EnvelopeNormalizer;
use Bernard\Normalizer\PlainMessageNormalizer;
use Bernard\QueueFactory\PersistentFactory;
use InteractiveSolutions\Bernard\Events\ClearObjectManager;
use InteractiveSolutions\Bernard\Factory\BernardOptionsFactory;
use InteractiveSolutions\Bernard\Factory\ConsumerFactory;
use InteractiveSolutions\Bernard\Factory\Driver\PhpRedisDriverFactory;
use InteractiveSolutions\Bernard\Factory\Events\ClearObjectManagerFactory;
use InteractiveSolutions\Bernard\Factory\Events\LogExceptionSubscriberFactory;
use InteractiveSolutions\Bernard\Factory\PersistentFactoryFactory;
use InteractiveSolutions\Bernard\Factory\ProducerFactory;
use InteractiveSolutions\Bernard\Factory\Router\ConsumerTaskManagerFactory;
use InteractiveSolutions\Bernard\Factory\Router\PluginManagerRouterFactory;
use InteractiveSolutions\Bernard\Normalizer\ExplicitNormalizer;
use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;
use InteractiveSolutions\Bernard\Router\PluginManagerRouter;
use Symfony\Component\EventDispatcher\EventDispatcher;

final class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'aliases' => [
                    \Bernard\Driver::class => PhpRedisDriver::class,
                ],

                'invokables' => [
                    EventDispatcherInterface::class => EventDispatcher::class,

                    ExplicitNormalizer::class     => ExplicitNormalizer::class,
                    EnvelopeNormalizer::class     => EnvelopeNormalizer::class,
                    PlainMessageNormalizer::class => PlainMessageNormalizer::class,
                ],

                'factories' => [
                    PhpRedisDriver::class => PhpRedisDriverFactory::class,

                    Consumer::class            => ConsumerFactory::class,
                    Producer::class            => ProducerFactory::class,
                    ConsumerTaskManager::class => ConsumerTaskManagerFactory::class,
                    PluginManagerRouter::class => PluginManagerRouterFactory::class,

                    BernardOptions::class    => BernardOptionsFactory::class,
                    PersistentFactory::class => PersistentFactoryFactory::class,

                    ClearObjectManager::class => ClearObjectManagerFactory::class,

                    LogExceptionSubscriberFactory::class => LogExceptionSubscriberFactory::class,
                ],
            ],
        ];
    }
}
