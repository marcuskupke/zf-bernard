<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

use InteractiveSolutions\Bernard\Controller\ConsoleController;

return [
    'console' => [
        'router' => [
            'routes' => [
                'bernard-consume' => [
                    'options' => [
                        'route'    => 'interactive-solutions:bernard:consume [--max-runtime=] [--stop-on-failure] [--stop-when-empty] [--max-messages=] <queue>',
                        'defaults' => [
                            'controller' => ConsoleController::class,
                            'action'     => 'consume',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
