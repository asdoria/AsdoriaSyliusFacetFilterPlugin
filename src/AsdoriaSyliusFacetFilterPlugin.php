<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin;

use Asdoria\SyliusFacetFilterPlugin\DependencyInjection\Complier\FormRegisterSearchFiltersPass;
use Sylius\Bundle\CoreBundle\Application\SyliusPluginTrait;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class AsdoriaSyliusFacetFilterPlugin
 * @package Asdoria\SyliusFacetFilterPlugin
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
final class AsdoriaSyliusFacetFilterPlugin extends Bundle
{
    use SyliusPluginTrait;


    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container->addCompilerPass(new FormRegisterSearchFiltersPass());
    }

}
