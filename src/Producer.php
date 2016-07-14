<?php
/**
 * @author    Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard;

use Bernard\Message;
use Bernard\Producer as BaseProducer;
use InteractiveSolutions\Bernard\Message\AbstractExplicitMessage;

class Producer extends BaseProducer
{
    /**
     * @param Message     $message
     * @param string|null $queueName
     */
    public function produce(Message $message, $queueName = null)
    {
        if ($message instanceof AbstractExplicitMessage) {
            return parent::produce($message, $queueName ?: $message->getQueue());
        }

        return parent::produce($message, $queueName);
    }
}
