<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;

/**
 * Interface FacetGroupAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetGroupAwareInterface
{
    /**
     * @return FacetGroupInterface|null
     */
    public function getFacetGroup(): ?FacetGroupInterface;

    /**
     * @param FacetGroupInterface|null $matrixFacetGroup
     */
    public function setFacetGroup(?FacetGroupInterface $matrixFacetGroup): void;
}
