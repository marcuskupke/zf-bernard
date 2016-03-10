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
                        'route'    => 'bernard consume [--max_runtime=] [--verbose|-v] <queue>',
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
