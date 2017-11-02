<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 2017-11-01
 * Time: 15:49
 */

namespace InteractiveSolutions\Bernard\Events;


use Bernard\BernardEvents;
use Bernard\Event\EnvelopeEvent;
use Bernard\Event\RejectEnvelopeEvent;
use InteractiveSolutions\Bernard\Message\AbstractExplicitMessage;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class NewrelicBackgroundTransaction implements EventSubscriberInterface
{
    public function begin(EnvelopeEvent $event)
    {
        if (!function_exists('newrelic_start_transaction')) {
            return;
        }

        newrelic_start_transaction(ini_get('newrelic.appname'));
        newrelic_background_job(true);
        newrelic_name_transaction($event->getEnvelope()->getName());
    }

    /**
     * This is called after a transaction has "successfully" finished
     */
    public function acknowledge()
    {
        if (!function_exists('newrelic_end_transaction')) {
            return;
        }

        newrelic_end_transaction();
    }

    /**
     * Reject is called when a task throws an exception
     *
     * @param RejectEnvelopeEvent $event
     */
    public function reject(RejectEnvelopeEvent $event)
    {
        if (!function_exists('newrelic_end_transaction')) {
            return;
        }

        newrelic_notice_error($event->getEnvelope()->getName(), $event->getException());
        newrelic_end_transaction();
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BernardEvents::INVOKE      => ['begin'],
            BernardEvents::ACKNOWLEDGE => ['acknowledge'],
            BernardEvents::REJECT      => ['reject'],
        ];
    }
}