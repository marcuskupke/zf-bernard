<?php
/**
 * @author    Jonas Eriksson <jonas.eriksson@interactivesolutions.se>
 *
 * @copyright Interactive Solutions
 */
declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Events;

use InteractiveSolutions\Bernard\Events\LogExceptionSubscriber;
use InteractiveSolutions\ZfLogHandler\Service\LogHandlerService;
use Interop\Container\ContainerInterface;

final class LogExceptionSubscriberFactory
{
    public function __invoke(ContainerInterface $container): LogExceptionSubscriber
    {
        /* @var $logHandlerService LogHandlerService */
        $logHandlerService = $container->get(LogHandlerService::class);

        return new LogExceptionSubscriber($logHandlerService);
    }
}
