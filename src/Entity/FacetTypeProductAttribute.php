<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Entity;


use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeGeneric;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeProductAttributeInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\ProductAttributeTrait;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class FacetTypeProductAttribute
 * @package Asdoria\SyliusFacetFilterPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTypeProductAttribute extends FacetTypeGeneric implements FacetTypeProductAttributeInterface
{
    use ProductAttributeTrait;

    public function getResource(): ?ResourceInterface {
        return $this->getProductAttribute();
    }
}
