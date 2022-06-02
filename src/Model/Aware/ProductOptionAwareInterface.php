<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;

use Sylius\Component\Product\Model\ProductOptionInterface;

/**
 * Interface ProductOptionAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface ProductOptionAwareInterface
{
    /**
     * @return ProductOptionInterface|null
     */
    public function getProductOption(): ?ProductOptionInterface;

    /**
     * @param ProductOptionInterface|null $productOption
     */
    public function setProductOption(?ProductOptionInterface $productOption): void;
}
