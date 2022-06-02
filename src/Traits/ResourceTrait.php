<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;

/**
 * Trait ResourceTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 */
trait ResourceTrait
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
