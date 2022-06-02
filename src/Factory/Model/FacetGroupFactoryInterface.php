<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Factory\Model;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

/**
 * Class MatrixFacetGroupFactoryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Factory\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetGroupFactoryInterface extends FactoryInterface
{
    /**
     * @param FacetGroupInterface $facetGroup
     *
     * @return FacetGroupInterface
     */
    public function createForParent(FacetGroupInterface $facetGroup): FacetGroupInterface;
}
