<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;

/**
 * Class FacetTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait FacetTrait
{
    protected ?FacetInterface $facet = null;

    /**
     * @return FacetInterface|null
     */
    public function getFacet(): ?FacetInterface
    {
        return $this->facet;
    }

    /**
     * @param FacetInterface|null $facet
     */
    public function setFacet(?FacetInterface $facet): void
    {
        $this->facet = $facet;
    }
}
