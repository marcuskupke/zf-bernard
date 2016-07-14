<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Events;

use Doctrine\Common\Persistence\ObjectManager;

final class ClearObjectManager
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    /**
     * ClearObjectManager constructor.
     *
     * @param ObjectManager $objectManager
     */
    public function __construct(ObjectManager $objectManager)
    {
        $this->objectManager = $objectManager;
    }

    public function __invoke()
    {
        $this->objectManager->clear();
    }
}
