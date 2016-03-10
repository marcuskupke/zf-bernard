<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace Is\Bernard\Factory\Driver;

use Redis;
use Bernard\Driver\PhpRedisDriver;
use Is\Bernard\Options\BernardOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class PhpRedisFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):PhpRedisDriver
    {
        /* @var $options BernardOptions */
        $options = $serviceLocator->get(BernardOptions::class);

        /* @var $instance Redis */
        $instance = $serviceLocator->get($options->getRedisInstanceKey());

        return new PhpRedisDriver($instance);
    }
}
