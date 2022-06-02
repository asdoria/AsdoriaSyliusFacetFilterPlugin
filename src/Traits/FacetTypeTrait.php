<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeGenericInterface;

/**
 * Class FacetTypeTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait FacetTypeTrait
{
    protected ?FacetTypeGenericInterface $facetType = null;

    /**
     * @return FacetTypeGenericInterface|null
     */
    public function getFacetType(): ?FacetTypeGenericInterface
    {
        return $this->facetType;
    }

    /**
     * @param FacetTypeGenericInterface|null $facetType
     */
    public function setFacetType(?FacetTypeGenericInterface $facetType): void
    {
        $this->facetType = $facetType;
    }
}
