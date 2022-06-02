<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


/**
 * Class DefaultLocaleTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait DefaultLocaleTrait
{
    protected ?string $defaultLocale;

    /**
     * @return string|null
     */
    public function getDefaultLocale(): ?string
    {
        return $this->defaultLocale;
    }

    /**
     * @param string|null $defaultLocale
     */
    public function setDefaultLocale(?string $defaultLocale): void
    {
        $this->defaultLocale = $defaultLocale;
    }
}
