<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Traits;

use Sylius\Component\Product\Model\ProductOptionInterface;

/**
 * Class ProductOptionTrait
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
trait ProductOptionTrait
{
    /** @var ProductOptionInterface|null */
    protected ?ProductOptionInterface $productOption;

    /**
     * @return ProductOptionInterface|null
     */
    public function getProductOption(): ?ProductOptionInterface
    {
        return $this->productOption;
    }

    /**
     * @param ProductOptionInterface|null $productOption
     */
    public function setProductOption(?ProductOptionInterface $productOption): void
    {
        $this->productOption = $productOption;
    }
}
