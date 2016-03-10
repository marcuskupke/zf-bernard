<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

use Bernard\Consumer;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer\SimpleSerializer;
use Is\Bernard\Factory\ConsumerFactory;
use Is\Bernard\Factory\PersistentFactoryFactory;
use Is\Bernard\Factory\Router\ConsumerPluginManagerFactory;
use Is\Bernard\Factory\Router\PluginManagerRouterFactory;
use Is\Bernard\PluginManagerRouter;
use Is\Bernard\Router\ConsumerPluginManager;

declare(strict_types = 1);

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
