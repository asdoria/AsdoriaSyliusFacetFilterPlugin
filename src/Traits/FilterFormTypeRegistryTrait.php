<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Asdoria\SyliusFacetFilterPlugin\Registry\Model\FilterFormTypeRegistryInterface;

/**
 * Class FilterFormTypeRegistryTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait FilterFormTypeRegistryTrait
{
    //asdoria.form_registry.search_type
    protected ?FilterFormTypeRegistryInterface $filterFormTypeRegistry = null;

    /**
     * @return FilterFormTypeRegistryInterface|null
     */
    public function getFilterFormTypeRegistry(): ?FilterFormTypeRegistryInterface
    {
        return $this->filterFormTypeRegistry;
    }

    /**
     * @param FilterFormTypeRegistryInterface|null $filterFormTypeRegistry
     */
    public function setFilterFormTypeRegistry(?FilterFormTypeRegistryInterface $filterFormTypeRegistry): void
    {
        $this->filterFormTypeRegistry = $filterFormTypeRegistry;
    }
}
