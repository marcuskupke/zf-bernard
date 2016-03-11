<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use Bernard\Consumer;
use Bernard\Driver\PhpRedisDriver;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\Producer;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer\JMSSerializer;
use Bernard\Serializer\SimpleSerializer;
use InteractiveSolutions\Bernard\BernardOptions;
use InteractiveSolutions\Bernard\Controller\ConsoleController;
use InteractiveSolutions\Bernard\Factory\BernardOptionsFactory;
use InteractiveSolutions\Bernard\Factory\ConsumerFactory;
use InteractiveSolutions\Bernard\Factory\Controller\ConsoleControllerFactory;
use InteractiveSolutions\Bernard\Factory\Driver\PhpRedisDriverFactory;
use InteractiveSolutions\Bernard\Factory\PersistentFactoryFactory;
use InteractiveSolutions\Bernard\Factory\ProducerFactory;
use InteractiveSolutions\Bernard\Factory\Router\ConsumerTaskManagerFactory;
use InteractiveSolutions\Bernard\Factory\Router\PluginManagerRouterFactory;
use InteractiveSolutions\Bernard\Factory\Serializer\JMSSerializerFactory;
use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;
use InteractiveSolutions\Bernard\Router\PluginManagerRouter;
use InteractiveSolutions\Bernard\Serializer\ExplicitSerializer;

return array_merge([
    'interactive_solutions' => [
        'bernard_consumer_manager' => [

        ],
    ],

    'service_manager' => [
        'aliases' => [
            Bernard\Driver::class     => PhpRedisDriver::class,
            Bernard\Serializer::class => ExplicitSerializer::class,
        ],

        'invokables' => [
            SimpleSerializer::class   => SimpleSerializer::class,
            MiddlewareBuilder::class  => MiddlewareBuilder::class,
            ExplicitSerializer::class => ExplicitSerializer::class,
        ],

        'factories' => [
            PhpRedisDriver::class => PhpRedisDriverFactory::class,
            JMSSerializer::class  => JMSSerializerFactory::class,

            Consumer::class            => ConsumerFactory::class,
            Producer::class            => ProducerFactory::class,
            ConsumerTaskManager::class => ConsumerTaskManagerFactory::class,
            PluginManagerRouter::class => PluginManagerRouterFactory::class,

            BernardOptions::class    => BernardOptionsFactory::class,
            PersistentFactory::class => PersistentFactoryFactory::class,
        ],
    ],

    'controllers' => [
        'factories' => [
            ConsoleController::class => ConsoleControllerFactory::class,
        ],
    ],

], include __DIR__ . '/route.config.php');
