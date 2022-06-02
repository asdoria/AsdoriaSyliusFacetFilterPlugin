<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Traits;

/**
 * Trait CodeTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 */
trait CodeTrait
{
    /**
     * @var string
     */
    protected $code = null;

    /**
     * @return null|string
     */
    public function getCode(): ?string
    {
        return $this->code;
    }

    /**
     * @param null|string $code
     */
    public function setCode(?string $code): void
    {
        $this->code = $code;
    }
}
