<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Entity;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeTaxonInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\TaxonTrait;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class FacetTypeTaxon
 * @package Asdoria\SyliusFacetFilterPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTypeTaxon extends FacetTypeGeneric implements FacetTypeTaxonInterface
{
    use TaxonTrait;

    public function getResource(): ?ResourceInterface {
        return $this->getTaxon();
    }
}
