<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Router;

use Bernard\Envelope;
use Bernard\Exception\ReceiverNotFoundException;
use Bernard\Router;
use InteractiveSolutions\Bernard\Router\ConsumerTaskManager;

class PluginManagerRouter implements Router
{
    /**
     * @var ConsumerTaskManager
     */
    private $consumerPluginManager;

    /**
     * PluginManagerRouter constructor.
     *
     * @param ConsumerTaskManager $consumerPluginManager
     */
    public function __construct(ConsumerTaskManager $consumerPluginManager)
    {
        $this->consumerPluginManager = $consumerPluginManager;
    }

    /**
     * {@inheritdoc}
     */
    public function map(Envelope $envelope)
    {
        if (!$this->consumerPluginManager->has($envelope->getName())) {
            throw new ReceiverNotFoundException(sprintf('Could not find the received for %s ', $envelope->getName()));
        }

        return $this->consumerPluginManager->get($envelope->getName());
    }
}
