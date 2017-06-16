<?php
/**
 * @author    Jonas Eriksson <jonas.eriksson@interactivesolutions.se>
 *
 * @copyright Interactive Solutions
 */
declare(strict_types=1);

namespace InteractiveSolutions\Bernard\Events;

use Bernard\Event\RejectEnvelopeEvent;
use InteractiveSolutions\ZfLogHandler\Service\LogHandlerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Zend\Hydrator\Reflection;

final class LogExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @var LogHandlerService
     */
    private $logHandlerService;

    /**
     * @param LogHandlerService $logHandlerService
     */
    public function __construct(LogHandlerService $logHandlerService)
    {
        $this->logHandlerService = $logHandlerService;
    }

    /**
     * @param RejectEnvelopeEvent $event
     */
    public function onReject(RejectEnvelopeEvent $event)
    {
        $context                          = [];
        $context['queue']                 = (string) $event->getQueue();
        $context['envelope']['name']      = (string) $event->getEnvelope()->getName();
        $context['envelope']['class']     = $event->getEnvelope()->getClass();
        $context['envelope']['timestamp'] = $event->getEnvelope()->getTimestamp();
        $context['envelope']['message']   = (new Reflection())->extract($event->getEnvelope()->getMessage());

        $this->logHandlerService->handleException($event->getException(), $context);
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            'bernard.reject' => ['onReject']
        ];
    }
}
