<?php

namespace Drupal\newCustom\Routing;

use Drupal\Core\DependencyInjection\ContainerBuilder;
use Drupal\Core\DependencyInjection\ServiceProviderBase;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Modifies the language manager service.
 */
class RouteSubscriber extends ServiceProviderBase
{

    /**
     * {@inheritdoc}
     */
    public function alter(ContainerBuilder $container)
    {
        // Overrides the language_manager service.
        $definition = $container->getDefinition('router.route_provider');
        $definition->setClass('Drupal\newCustom\Routing\RouteProvider');
        $definition->addArgument(new Reference('request_stack'));
    }

}