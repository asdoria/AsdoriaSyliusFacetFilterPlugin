<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;

use Sylius\Component\Product\Model\ProductAttributeInterface;

/**
 * Interface ProductAttributeAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface ProductAttributeAwareInterface
{
    /**
     * @return ProductAttributeInterface|null
     */
    public function getProductAttribute(): ?ProductAttributeInterface;

    /**
     * @param ProductAttributeInterface|null $productAttribute
     */
    public function setProductAttribute(?ProductAttributeInterface $productAttribute): void;
}
