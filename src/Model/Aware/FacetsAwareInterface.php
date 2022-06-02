<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;


use Doctrine\Common\Collections\Collection;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
/**
 * Interface FacetsAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetsAwareInterface
{
    /**
     * @return Collection|null
     */
    public function getFacets(): ?Collection;

    /**
     * FacetsTrait constructor.
     */
    public function initializeFacetsCollection();

    /**
     * @return bool
     */
    public function hasFacets(): bool;

    /**
     * @param FacetInterface $facet
     *
     * @return bool
     */
    public function hasFacet(FacetInterface $facet): bool;

    /**
     * @param FacetInterface $facet
     */
    public function addFacet(FacetInterface $facet): void;

    /**
     * @param FacetInterface $facet
     */
    public function removeFacet(FacetInterface $facet): void;
}
