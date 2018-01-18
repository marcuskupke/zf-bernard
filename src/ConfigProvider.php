<?php
/**
 * @copyright Interactive Solutions
 */

declare(strict_types=1);

namespace InteractiveSolutions\Bernard;

final class ConfigProvider
{
    public function __invoke()
    {
        return [
            'interactive_solutions' => [
                'bernard_consumer_manager' => [

                ],
            ],

            'dependencies' => [
                'aliases' => [
                    Bernard\Driver::class => PhpRedisDriver::class,
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
