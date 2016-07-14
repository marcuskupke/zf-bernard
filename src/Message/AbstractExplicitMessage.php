<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Message;

use Bernard\Message;

abstract class AbstractExplicitMessage implements Message
{
    abstract public function getQueue(): string;
}
