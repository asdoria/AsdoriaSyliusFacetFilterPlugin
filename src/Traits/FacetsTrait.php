<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Traits;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Trait FacetsTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 */
trait FacetsTrait
{
    /** @var Collection|null */
    protected Collection $facets;

    /**
     * FacetsTrait constructor.
     */
    public function initializeFacetsCollection()
    {
        $this->facets = new ArrayCollection();
    }

    /**
     * @return Collection|null
     */
    public function getFacets(): Collection
    {
        return $this->facets;
    }

    /**
     * @return bool
     */
    public function hasFacets(): bool
    {
        return !$this->facets->isEmpty();
    }

    /**
     * @param FacetInterface $facet
     *
     * @return bool
     */
    public function hasFacet(FacetInterface $facet): bool
    {
        return $this->facets->contains($facet);
    }

    /**
     * @param FacetInterface $facet
     */
    public function addFacet(FacetInterface $facet): void
    {
        $this->facets->add($facet);
        $facet->setFacetFilter($this);
    }

    /**
     * @param FacetInterface $facet
     */
    public function removeFacet(FacetInterface $facet): void
    {
        if ($this->hasFacet($facet)) {
            $this->facets->removeElement($facet);
            $facet->setFacetFilter(null);
        }
    }
}
