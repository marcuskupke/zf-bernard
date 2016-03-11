<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use Bernard\Consumer;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer\SimpleSerializer;
use InteractiveSolutions\Bernard\Factory\ConsumerFactory;
use InteractiveSolutions\Bernard\Factory\PersistentFactoryFactory;
use InteractiveSolutions\Bernard\Factory\Router\ConsumerPluginManagerFactory;
use InteractiveSolutions\Bernard\Factory\Router\PluginManagerRouterFactory;
use InteractiveSolutions\Bernard\PluginManagerRouter;
use InteractiveSolutions\Bernard\Router\ConsumerPluginManager;

return array_merge([
    'interactive_solutions' => [
        'bernard_consumer_manager' => [

        ],
    ],

    'service_manager' => [
        'invokables' => [
            SimpleSerializer::class  => SimpleSerializer::class,
            MiddlewareBuilder::class => MiddlewareBuilder::class,
        ],

        'factories' => [
            Consumer::class              => ConsumerFactory::class,
            ConsumerPluginManager::class => ConsumerPluginManagerFactory::class,
            PluginManagerRouter::class   => PluginManagerRouterFactory::class,

            PersistentFactory::class => PersistentFactoryFactory::class,
        ],
    ],

], include __DIR__ . '/route.config.php');
