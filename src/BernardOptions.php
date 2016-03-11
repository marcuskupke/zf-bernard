<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard;

use Bernard\QueueFactory\PersistentFactory;
use Redis;

class BernardOptions
{
    /**
     * @var string
     */
    protected $redisInstanceKey = Redis::class;

    /**
     * @var string
     */
    protected $queueInstanceKey = PersistentFactory::class;

    /**
     * @return string
     */
    public function getQueueInstanceKey():string
    {
        return $this->queueInstanceKey;
    }

    /**
     * @param string $queueInstanceKey
     */
    public function setQueueInstanceKey(string $queueInstanceKey)
    {
        $this->queueInstanceKey = $queueInstanceKey;
    }

    /**
     * @return string
     */
    public function getRedisInstanceKey():string
    {
        return $this->redisInstanceKey;
    }

    /**
     * @param string $redisInstanceKey
     */
    public function setRedisInstanceKey(string $redisInstanceKey)
    {
        $this->redisInstanceKey = $redisInstanceKey;
    }
}
