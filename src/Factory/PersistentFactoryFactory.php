<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory;

use Bernard\Driver;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Serializer;
use InteractiveSolutions\Bernard\BernardOptions;
use Interop\Container\ContainerInterface;
use Normalt\Normalizer\AggregateNormalizer;

class PersistentFactoryFactory
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container): PersistentFactory
    {
        /* @var $driver Driver */
        $driver = $container->get(Driver::class);

        /* @var $options BernardOptions */
        $options = $container->get(BernardOptions::class);

        $normalizers = [];

        foreach ($options->getEnabledNormalizers() as $normalizer) {
            $normalizers[] = $container->get($normalizer);
        }

        $serializer = new Serializer(new AggregateNormalizer($normalizers));

        return new PersistentFactory($driver, $serializer);
    }
}
