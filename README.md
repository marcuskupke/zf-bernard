ZF-Bernard
==========
![Code Quality](https://scrutinizer-ci.com/g/interactive-solutions/zf-bernard/badges/quality-score.png?b=master)
![Build status](https://scrutinizer-ci.com/g/interactive-solutions/zf-bernard/badges/build.png?b=master)

Provides zend framework 2, 3 and zend-expressive integrations

## Installing

We support installation via composer, note for now you need to set the minimum stability to alpha to install

`composer require interactive-solutions/zf-bernard`

## Normalizers

You can add any normalizer that you wish to use by adding it to the `BernardOptions::enabledNormalizers`

The default enabled normalizers are

* `Bernard\Normalizer\DefaultMessageNormalizer`
* `Bernard\Normalider\EnvelopeNormalizer`
* `InteractiveSolutions\Bernard\Normalizer\ExplicitNormalizer`

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

## Hooking into the event manager using a delegate factory

This delegate factory supports both zend framework service manager 2 & 3, read more about it [here](
 https://zendframework.github.io/zend-servicemanager/migration/#factories) 
 
 
Example of introducing the ClearObjectManager event listener
```php
final class EventDispatcherDelegateFactory implements DelegatorFactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, callable $callback, array $options = null)
    {
        /* @var $dispatcher EventDispatcherInterface */
        $dispatcher = $callback();
        $dispatcher->addListener(BernardEvents::ACKNOWLEDGE, $container->get(ClearObjectManager::class));

        return $dispatcher;
    }

    public function createDelegatorWithName(ServiceLocatorInterface $serviceLocator, $name, $requestedName, $callback)
    {
        return $this($serviceLocator, $requestedName, $callback);
    }
}
```
