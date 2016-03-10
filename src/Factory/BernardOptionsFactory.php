<?php
/**
 * @author    Antoine Hedgecock <antoine.hedgecock@gmail.com>
 *
 * @copyright Interactive Solutions
 */

declare(strict_types = 1);

namespace InteractiveSolutions\Bernard\Factory;

use InteractiveSolutions\Bernard\Options\BernardOptions;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class BernardOptionsFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator):BernardOptions
    {
        /* @var $config array */
        $config = $serviceLocator->get('config');
        $config = $config['interactive_solutions']['options'][BernardOptions::class] ?? [];

        return new BernardOptions($config);
    }
}
