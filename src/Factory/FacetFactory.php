<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Factory;

use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeProductAttribute;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeProductOption;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeTaxon;
use Asdoria\SyliusFacetFilterPlugin\Factory\Model\FacetFactoryInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;

/**
 * Class FacetGroupFactory
 * @package Asdoria\SyliusFacetFilterPlugin\Factory
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFactory implements FacetFactoryInterface
{
    /** @var string */
    private $className;

    /**
     * MatrixFacetGroupFactory constructor.
     *
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    /**
     * {@inheritdoc}
     */
    public function createNew(): FacetInterface
    {
        return new $this->className();
    }

    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetInterface
     */
    public function createForProductAttribute(FacetFilterInterface $facetFilter): FacetInterface
    {
        $facet = $this->createNew();
        $facet->setFacetFilter($facetFilter);
        $facet->setFacetType(new FacetTypeProductAttribute());

        return $facet;
    }

    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetInterface
     */
    public function createForProductOption(FacetFilterInterface $facetFilter): FacetInterface
    {
        $facet = $this->createNew();
        $facet->setFacetFilter($facetFilter);
        $facet->setFacetType(new FacetTypeProductOption());

        return $facet;
    }

    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetInterface
     */
    public function createForTaxon(FacetFilterInterface $facetFilter): FacetInterface
    {
        $facet = $this->createNew();
        $facet->setFacetFilter($facetFilter);
        $facet->setFacetType(new FacetTypeTaxon());

        return $facet;
    }
}
