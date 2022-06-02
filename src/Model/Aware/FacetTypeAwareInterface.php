<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeGenericInterface;

/**
 * Interface FacetTypeAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetTypeAwareInterface
{
    /**
     * @return FacetTypeGenericInterface|null
     */
    public function getFacetType(): ?FacetTypeGenericInterface;

    /**
     * @param FacetTypeGenericInterface|null $facetType
     */
    public function setFacetType(?FacetTypeGenericInterface $facetType): void;
}
