<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;

/**
 * Trait FacetGroupTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait FacetGroupTrait
{
    /** @var FacetGroupInterface|null */
    protected FacetGroupInterface $facetGroup;

    /**
     * @return FacetGroupInterface|null
     */
    public function getFacetGroup(): ?FacetGroupInterface
    {
        return $this->facetGroup;
    }

    /**
     * @param FacetGroupInterface|null $facetGroup
     */
    public function setFacetGroup(?FacetGroupInterface $facetGroup): void
    {
        $this->facetGroup = $facetGroup;
    }
}
