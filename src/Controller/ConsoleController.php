<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Controller;

use Bernard\Consumer;
use Bernard\QueueFactory;
use Zend\Mvc\Controller\AbstractConsoleController;

class ConsoleController extends AbstractConsoleController
{
    /**
     * @var QueueFactory
     */
    private $factory;

    /**
     * @var Consumer
     */
    private $consumer;

    /**
     * ConsoleController constructor.
     *
     * @param Consumer     $consumer
     * @param QueueFactory $factory
     */
    public function __construct(Consumer $consumer, QueueFactory $factory)
    {
        $this->factory  = $factory;
        $this->consumer = $consumer;
    }

    public function consumeAction()
    {

    }
}
