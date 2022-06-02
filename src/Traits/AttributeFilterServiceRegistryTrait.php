<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model\AttributeFilterServiceRegistryInterface;

/**
 * Class AttributeFilterServiceRegistryTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait AttributeFilterServiceRegistryTrait
{
    protected AttributeFilterServiceRegistryInterface $filterServiceRegistry;

    /**
     * @return AttributeFilterServiceRegistryInterface
     */
    public function getFilterServiceRegistry(): AttributeFilterServiceRegistryInterface
    {
        return $this->filterServiceRegistry;
    }

    /**
     * @param AttributeFilterServiceRegistryInterface $filterServiceRegistry
     */
    public function setFilterServiceRegistry(AttributeFilterServiceRegistryInterface $filterServiceRegistry): void
    {
        $this->filterServiceRegistry = $filterServiceRegistry;
    }
}
