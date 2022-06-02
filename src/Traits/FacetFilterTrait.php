<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Doctrine\ORM\Mapping as ORM;
/**
 * Trait FacetFilterTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait FacetFilterTrait
{

    /**
     * @var FacetFilterInterface|null
     *
     * @ORM\ManyToOne(
     *      targetEntity="Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface",
     *      inversedBy="referrals")
     */
    protected FacetFilterInterface $facetFilter;

    /**
     * @return FacetFilterInterface|null
     */
    public function getFacetFilter(): ?FacetFilterInterface
    {
        return $this->facetFilter;
    }

    /**
     * @param FacetFilterInterface|null $facetFilter
     */
    public function setFacetFilter(?FacetFilterInterface $facetFilter): void
    {
        $this->facetFilter = $facetFilter;
    }
}
