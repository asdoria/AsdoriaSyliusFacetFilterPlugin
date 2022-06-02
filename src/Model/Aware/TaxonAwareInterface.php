<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;

use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * Interface TaxonAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface TaxonAwareInterface
{
    /**
     * @return TaxonInterface|null
     */
    public function getTaxon(): ?TaxonInterface;

    /**
     * @param TaxonInterface|null $taxon
     */
    public function setTaxon(?TaxonInterface $taxon): void;
}
