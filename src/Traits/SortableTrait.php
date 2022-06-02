<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


/**
 * Trait SortableTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 */
trait SortableTrait
{

    /** @var int */
    protected $position = 0;

    /**
     * @return int
     */
    public function getPosition(): ?int
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }
}
