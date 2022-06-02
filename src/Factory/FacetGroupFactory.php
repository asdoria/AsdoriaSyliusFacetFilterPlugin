<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Factory;

use Asdoria\SyliusFacetFilterPlugin\Factory\Model\FacetGroupFactoryInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;

/**
 * Class FacetGroupFactory
 * @package Asdoria\SyliusFacetFilterPlugin\Factory
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetGroupFactory implements FacetGroupFactoryInterface
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
    public function createNew(): FacetGroupInterface
    {
        return new $this->className();
    }

    /**
     * @param FacetGroupInterface $facetGroup
     *
     * @return FacetGroupInterface
     */
    public function createForParent(FacetGroupInterface $facetGroup): FacetGroupInterface
    {
        $pictogram = $this->createNew();
        $pictogram->setParent($facetGroup);

        return $pictogram;
    }
}
