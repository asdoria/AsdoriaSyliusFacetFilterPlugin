<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Factory;

use Asdoria\SyliusFacetFilterPlugin\Factory\Model\FacetFilterFactoryInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;

/**
 * Class FacetFilterFactory
 * @package Asdoria\SyliusFacetFilterPlugin\Factory
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilterFactory implements FacetFilterFactoryInterface
{
    /** @var string */
    private $className;

    /**
     * FacetFilterFactory constructor.
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
    public function createNew(): FacetFilterInterface
    {
        return new $this->className();
    }

    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetFilterInterface
     */
    public function createForParent(FacetFilterInterface $facetFilter): FacetFilterInterface
    {
        $facetFilter = $this->createNew();
        $facetFilter->setParent($facetFilter);

        return $facetFilter;
    }
}
