<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;

use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetFilterCodeAwareInterface;

/**
 *
 */
trait FacetFilterCodeAwareTrait
{
    /**
     * @var FacetFilterCodeAwareInterface|null
     */
    protected ?FacetFilterCodeAwareInterface $facetFilterCodeAware = null;

    /**
     * @return FacetFilterCodeAwareInterface|null
     */
    public function getFacetFilterCodeAware(): ?FacetFilterCodeAwareInterface
    {
        return $this->facetFilterCodeAware;
    }

    /**
     * @param FacetFilterCodeAwareInterface|null $facetFilterCodeAware
     */
    public function setFacetFilterCodeAware(?FacetFilterCodeAwareInterface $facetFilterCodeAware): void
    {
        $this->facetFilterCodeAware = $facetFilterCodeAware;
    }
}
