<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Router;

use InteractiveSolutions\Bernard\Router\Exception\InvalidPluginException;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\Exception;

class ConsumerTaskManager extends AbstractPluginManager
{
    protected $autoAddInvokableClass = false;

    /**
     * {@inheritdoc]
     */
    public function validate($plugin)
    {
        if (!is_callable($plugin)) {
            throw new InvalidPluginException(sprintf(
                'Plugin of type %s is invalid; must implement %s\Plugin\PluginInterface',
                (is_object($plugin) ? get_class($plugin) : gettype($plugin)),
                __NAMESPACE__
            ));
        }
    }
}
