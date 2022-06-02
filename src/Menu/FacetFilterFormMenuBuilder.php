<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Menu;

use Asdoria\Bundle\FacetFilterBundle\Model\TaxonGroupInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;


/**
 * Class FacetFilterFormMenuBuilder
 * @package Asdoria\SyliusFacetFilterPlugin\Menu
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilterFormMenuBuilder
{
    public const EVENT_NAME = 'sylius.menu.admin.facet_filter.form';

    /** @var FactoryInterface */
    private FactoryInterface $factory;

    /** @var EventDispatcherInterface */
    private EventDispatcherInterface $eventDispatcher;

    /**
     * @param FactoryInterface         $factory
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(FactoryInterface $factory, EventDispatcherInterface $eventDispatcher)
    {
        $this->factory = $factory;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param array $options
     *
     * @return ItemInterface
     */
    public function createMenu(array $options = []): ItemInterface
    {
        $menu = $this->factory->createItem('root');
        $facetFilter = $options['facetFilter'] ?? null;
        if (!$facetFilter instanceof FacetFilterInterface) {
            return $menu;
        }


        $manageFacetItem = $this->factory
            ->createItem('manage_facet_filter_filters', [
                'route' => 'asdoria_admin_facet_index',
                'routeParameters' => ['facetFilterId' => $facetFilter->getId()],
            ])
            ->setAttribute('type', 'link')
            ->setLabel('asdoria.ui.list_facet_filter_filters')
            ->setLabelAttribute('icon', 'cubes')
        ;

        $menu->addChild($manageFacetItem);

        return $menu;
    }
}
