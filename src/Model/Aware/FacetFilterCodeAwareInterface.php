<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Model\Aware;


/**
 * Class FacetFilterCodeAwareInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model\Aware
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetFilterCodeAwareInterface
{
    /**
     * @return string|null
     */
    public function getFacetFilterCode(): ?string;

    /**
     * @param string|null $facetFilterCode
     */
    public function setFacetFilterCode(?string $facetFilterCode): void;
}
