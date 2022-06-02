<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;

/**
 * Interface FacetFilterAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetFilterAwareInterface
{
    /**
     * @return FacetFilterInterface|null
     */
    public function getFacetFilter(): ?FacetFilterInterface;

    /**
     * @param FacetFilterInterface|null $matrixFacetFilter
     */
    public function setFacetFilter(?FacetFilterInterface $matrixFacetFilter): void;
}
