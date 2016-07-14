<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use Bernard\Consumer;
use Bernard\Driver\PhpRedisDriver;
use Bernard\QueueFactory\PersistentFactory;
use InteractiveSolutions\Bernard\BernardOptions;
use InteractiveSolutions\Bernard\Controller\ConsoleController;
use InteractiveSolutions\Bernard\EventDispatcherInterface;
use InteractiveSolutions\Bernard\Factory\BernardOptionsFactory;
use InteractiveSolutions\Bernard\Factory\ConsumerFactory;
use InteractiveSolutions\Bernard\Factory\Controller\ConsoleControllerFactory;
use InteractiveSolutions\Bernard\Factory\Driver\PhpRedisDriverFactory;
use InteractiveSolutions\Bernard\Factory\PersistentFactoryFactory;
use InteractiveSolutions\Bernard\Factory\ProducerFactory;
use InteractiveSolutions\Bernard\Factory\Router\ConsumerTaskManagerFactory;
use InteractiveSolutions\Bernard\Factory\Router\PluginManagerRouterFactory;
use InteractiveSolutions\Bernard\Normalizer\ExplicitNormalizer;
use InteractiveSolutions\Bernard\Producer;
use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;
use InteractiveSolutions\Bernard\Router\PluginManagerRouter;
use Symfony\Component\EventDispatcher\EventDispatcher;

return array_merge([
    'interactive_solutions' => [
        'bernard_consumer_manager' => [

        ],
    ],

    'service_manager' => [
        'aliases' => [
            Bernard\Driver::class     => PhpRedisDriver::class,
            Bernard\Serializer::class => ExplicitNormalizer::class,
        ],

        'invokables' => [
            ExplicitNormalizer::class       => ExplicitNormalizer::class,
            EventDispatcherInterface::class => EventDispatcher::class,
        ],

        'factories' => [
            PhpRedisDriver::class => PhpRedisDriverFactory::class,

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
