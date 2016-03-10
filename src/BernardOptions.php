<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Options;

use Redis;

class BernardOptions
{
    /**
     * @var string
     */
    protected $redisInstanceKey = Redis::class;

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
