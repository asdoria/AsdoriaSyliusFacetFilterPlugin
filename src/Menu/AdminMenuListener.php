<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;

/**
 * Class AdminMenuListener
 * @package Asdoria\SyliusFacetFilterPlugin\Menu
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AdminMenuListener
{
    /**
     * @param MenuBuilderEvent $event
     */
    public function addMenuItems(MenuBuilderEvent $event)
    {
        $menu = $event->getMenu();

        $configuration = $menu->getChild('configuration');
        $configuration->addChild('facet_filter' , ['route' => 'asdoria_admin_facet_filter_index'])
            ->setLabel('asdoria.menu.admin.main.facet_filter.header')
            ->setLabelAttribute('icon', 'list');
    }
}
