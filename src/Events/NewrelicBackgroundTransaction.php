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

class NewrelicBackgroundTransaction
{

    public function begin(EnvelopeEvent $event)
    {
        if (!function_exists('newrelic_start_transaction')) {
            return;
        }

        $message = $event->getEnvelope()->getMessage();
        if ($message instanceof AbstractExplicitMessage) {
            newrelic_start_transaction($message->getName());
        }  else {
            newrelic_start_transaction($event->getEnvelope()->getName());
        }
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
        if (!function_exists('newrelic_end_transaction'))  {
            return;
        }

        $message = $event->getEnvelope()->getMessage();
        if ($message instanceof AbstractExplicitMessage) {
            newrelic_notice_error($message->getName(), $event->getException());
            newrelic_end_transaction();
        } else {
            newrelic_notice_error($message->getName());
            newrelic_end_transaction();
        }
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BernardEvents::INVOKE => ['begin'],
            BernardEvents::ACKNOWLEDGE => ['acknowledge'],
            BernardEvents::REJECT => ['reject']
        ];
    }
}