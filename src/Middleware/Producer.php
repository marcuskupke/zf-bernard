<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Middleware;

use Bernard\Producer as BaseProducer;
use InteractiveSolutions\Bernard\Serializer\AbstractExplicitMessage;

class Producer extends BaseProducer
{
    public function produce(AbstractExplicitMessage $message)
    {
        parent::produce($message, $message->getQueue());
    }
}
