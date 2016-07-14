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
use InteractiveSolutions\Bernard\Producer;
use Zend\Mvc\Controller\AbstractConsoleController;

/**
 * Class ConsoleController
 *
 * @method \Zend\Console\Request getRequest
 */
class ConsoleController extends AbstractConsoleController
{
    /**
     * @var QueueFactory
     */
    private $queues;

    /**
     * @var Consumer
     */
    private $consumer;

    /**
     * @var Producer
     */
    private $producer;

    /**
     * ConsoleController constructor.
     *
     * @param Producer     $producer
     * @param Consumer     $consumer
     * @param QueueFactory $queues
     */
    public function __construct(Producer $producer, Consumer $consumer, QueueFactory $queues)
    {
        $this->queues   = $queues;
        $this->consumer = $consumer;
        $this->producer = $producer;
    }

    public function consumeAction()
    {
        $queue = $this->queues->create($this->getRequest()->getParam('queue'));

        $this->consumer->consume($queue, [
            'max-runtime' => $this->getRequest()->getParam('max-runtime'),
        ]);
    }
}
