<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Serializer;

use Bernard\Envelope;
use Bernard\Serializer;
use InvalidArgumentException;
use ReflectionClass;

class ExplicitSerializer implements Serializer
{
    /**
     * @param  Envelope $envelope
     *
     * @return string
     */
    public function serialize(Envelope $envelope)
    {
        $message = $envelope->getMessage();
        if (!$message instanceof AbstractExplicitMessage) {
            throw new InvalidArgumentException();
        }

        $reflection = new ReflectionClass($message);

        $args = [];

        foreach ($reflection->getProperties() as $property) {
            $property->setAccessible(true);

            $args[$property->getName()] = $property->getValue($message);
        }

        return json_encode([
            'args'      => $args,
            'class'     => $envelope->getClass(),
            'timestamp' => $envelope->getTimestamp(),
        ]);
    }

    /**
     * @return Envelope
     */
    public function deserialize($serialized)
    {
        $data = json_decode($serialized);

        $reflection = new ReflectionClass($data->class);

        $instance = $reflection->newInstanceWithoutConstructor();

        foreach ($data->args as $key => $value) {
            $property = $reflection->getProperty($key);
            $property->setAccessible(true);
            $property->setValue($instance, $value);
        }

        $reflection = new ReflectionClass(AbstractExplicitMessage::class);

        $property = $reflection->getProperty('timestamp');
        $property->setAccessible(true);
        $property->setValue($instance, $data->timestamp);

        return new Envelope($instance);
    }
}
