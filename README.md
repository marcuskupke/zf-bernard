ZF-Bernard
==========
Provides zend framework 2 and zend-expressive integrations

## Installing

We support installation via composer

```composer require interactive-solutions/zf-bernard```

## Add to the queue

Create an object extending the `AbstractExplicitMessage` class and
it to the producer queue like this:

```php
final class SomeClass
{
    // This method is called when the task is consumed
    public function __invoke(Message $message)
    {
        // do stuff
    }
}

final class Message extends AbstractExplicitMessage
{
    // various parameters for your application

    /**
     * Message constructor.
     */
    public function __construct(...parameters)
    {
        // Initialize parameters
    }
    
    /**
     * @return string
     */
    public function getName()
    {
        return SomeClass::class;
    }

    // getters for your parameters

    public function getQueue(): string
    {
        return 'some-queue';
    }
}

$producer->produce(new Message(...parameters));
```

Register the `SomeClass` under `bernard_consumer_manager` in the config
and you're done.
