<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Factory\Model;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * Interface FacetFilterFactoryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Factory\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetFilterFactoryInterface extends FactoryInterface
{
    /**
     * @param FacetFilterInterface $facetFilter
     *
     * @return FacetFilterInterface
     */
    public function createForParent(FacetFilterInterface $facetFilter): FacetFilterInterface;
}
