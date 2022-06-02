<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\DependencyInjection\Complier;


use \InvalidArgumentException;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
/**
 * Class SearchFilterRegisterFiltersPass
 * @package Asdoria\SyliusFacetFilterPlugin\DependencyInjection\Complier
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FormRegisterSearchFiltersPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition('asdoria.form_registry.facet_type_filter') || !$container->hasDefinition('asdoria.facet_registry.filter')) {
            return;
        }

        $formTypeRegistry = $container->getDefinition('asdoria.form_registry.facet_type_filter');
        $filterRegistry = $container->getDefinition('asdoria.facet_registry.filter');

        foreach ($container->findTaggedServiceIds('asdoria.search_filter') as $id => $attributes) {
            foreach ($attributes as $attribute) {
                if (!isset($attribute['type'], $attribute['class_type'], $attribute['form_type'])) {
                    throw new InvalidArgumentException('Tagged search filters needs to have `type`, and `class_type`, and `form_type` attributes.');
                }

                $formTypeRegistry->addMethodCall('add', [$attribute['class_type'], $attribute['type'], $attribute['form_type']]);
                $filterRegistry->addMethodCall('register', [$attribute['type'], new Reference($id)]);
            }
        }
    }
}


