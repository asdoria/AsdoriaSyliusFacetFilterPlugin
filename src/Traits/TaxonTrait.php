<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * Trait TaxonTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 */
trait TaxonTrait
{
    /** @var TaxonInterface|null */
    protected ?TaxonInterface $taxon;

    /**
     * @return TaxonInterface|null
     */
    public function getTaxon(): ?TaxonInterface
    {
        return $this->taxon;
    }

    /**
     * @param TaxonInterface|null $taxon
     */
    public function setTaxon(?TaxonInterface $taxon): void
    {
        $this->taxon = $taxon;
    }
}
