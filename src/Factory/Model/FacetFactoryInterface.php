<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Factory\Model;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * Class FacetFactoryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Factory\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetFactoryInterface extends FactoryInterface
{
    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetInterface
     */
    public function createForProductAttribute(FacetFilterInterface $facetFilter): FacetInterface;


    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetInterface
     */
    public function createForProductOption(FacetFilterInterface $facetFilter): FacetInterface;


    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetInterface
     */
    public function createForTaxon(FacetFilterInterface $facetFilter): FacetInterface;
}
