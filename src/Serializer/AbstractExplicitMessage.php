<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Serializer;

use Bernard\Message;

abstract class AbstractExplicitMessage implements Message
{
    /**
     * @var int
     */
    private $timestamp;

    /**
     * @return int
     */
    public function getTimestamp():int
    {
        return $this->timestamp;
    }
}
