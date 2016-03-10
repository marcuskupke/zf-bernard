<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard;

use Bernard\Envelope;
use Bernard\Router;
use InteractiveSolutions\Bernard\Router\ConsumerPluginManager;

class PluginManagerRouter implements Router
{
    /**
     * @var ConsumerPluginManager
     */
    private $consumerPluginManager;

    /**
     * PluginManagerRouter constructor.
     *
     * @param ConsumerPluginManager $consumerPluginManager
     */
    public function __construct(ConsumerPluginManager $consumerPluginManager)
    {
        $this->consumerPluginManager = $consumerPluginManager;
    }

    /**
     * {@inheritdoc}
     */
    public function map(Envelope $envelope)
    {
        // TODO: Implement map() method.
    }
}
