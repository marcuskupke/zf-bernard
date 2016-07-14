<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory\Events;

use Doctrine\Common\Persistence\ObjectManager;
use InteractiveSolutions\Bernard\BernardOptions;
use InteractiveSolutions\Bernard\Events\ClearObjectManager;
use Interop\Container\ContainerInterface;

final class ClearObjectManagerFactory
{
    public function __invoke(ContainerInterface $container): ClearObjectManager
    {
        /* @var $options BernardOptions */
        $options = $container->get(BernardOptions::class);

        /* @var $objectManager ObjectManager */
        $objectManager = $container->get($options->getObjectManagerInstanceKey());

        return new ClearObjectManager($objectManager);
    }
}
