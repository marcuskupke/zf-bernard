<?php
/**
 * @author Erik Norgren <erik.norgren@interactivesolutions.se>
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Middleware;

use Bernard\Envelope;
use Bernard\Middleware;
use Bernard\Middleware\MiddlewareBuilder;
use Bernard\Queue;
use Bernard\QueueFactory;
use InteractiveSolutions\Bernard\Serializer\AbstractExplicitMessage;

class Producer implements Middleware
{
    protected $queues;
    protected $middleware;

    /**
     * @param QueueFactory      $queues
     * @param MiddlewareBuilder $middleware
     */
    public function __construct(QueueFactory $queues, MiddlewareBuilder $middleware)
    {
        $this->queues     = $queues;
        $this->middleware = $middleware;
    }

    /**
     * @param AbstractExplicitMessage $message
     */
    public function produce(AbstractExplicitMessage $message)
    {
        $queue = $this->queues->create($message->getQueue());

        $middleware = $this->middleware->build($this);
        $middleware->call(new Envelope($message), $queue);
    }

    /**
     * {@inheritDoc}
     */
    public function call(Envelope $envelope, Queue $queue)
    {
        $queue->enqueue($envelope);
    }
}
