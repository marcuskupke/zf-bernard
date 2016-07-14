<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard;

use Bernard\Normalizer\DefaultMessageNormalizer;
use Bernard\Normalizer\EnvelopeNormalizer;
use Bernard\QueueFactory\PersistentFactory;
use Doctrine\Common\Persistence\ObjectManager;
use InteractiveSolutions\Bernard\Normalizer\ExplicitNormalizer;
use Redis;
use Zend\Stdlib\AbstractOptions;

class BernardOptions extends AbstractOptions
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
     * @var string
     */
    protected $objectManagerInstanceKey = ObjectManager::class;

    /**
     * @var array
     */
    protected $enabledNormalizers = [
        EnvelopeNormalizer::class,
        ExplicitNormalizer::class,
        DefaultMessageNormalizer::class
    ];

    /**
     * @return array
     */
    public function getEnabledNormalizers(): array
    {
        return $this->enabledNormalizers;
    }

    /**
     * @param array $enabledNormalizers
     */
    public function setEnabledNormalizers(array $enabledNormalizers)
    {
        $this->enabledNormalizers = $enabledNormalizers;
    }


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

    /**
     * @return string
     */
    public function getObjectManagerInstanceKey(): string
    {
        return $this->objectManagerInstanceKey;
    }

    /**
     * @param string $objectManagerInstanceKey
     */
    public function setObjectManagerInstanceKey(string $objectManagerInstanceKey)
    {
        $this->objectManagerInstanceKey = $objectManagerInstanceKey;
    }
}
