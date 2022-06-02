<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Entity;

use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeGeneric;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeProductOptionInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\ProductOptionTrait;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class FacetTypeProductOption
 * @package Asdoria\SyliusFacetFilterPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTypeProductOption extends FacetTypeGeneric implements FacetTypeProductOptionInterface
{
    use ProductOptionTrait;

    public function getResource(): ?ResourceInterface {
        return $this->getProductOption();
    }
}
