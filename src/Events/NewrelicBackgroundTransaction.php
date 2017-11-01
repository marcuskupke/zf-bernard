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

    public function terminate()
    {
        if (!function_exists('newrelic_end_transaction')) {
            return;
        }

        newrelic_end_transaction();
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            BernardEvents::INVOKE => ['onInvoke'],
            BernardEvents::ACKNOWLEDGE => ['terminate'],
            BernardEvents::REJECT => ['terminate']
        ];
    }
}