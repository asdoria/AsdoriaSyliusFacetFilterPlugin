<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 */
trait FacetFilterCodeTrait
{
    /**
     * @var string
     * @ORM\Column(type="string", nullable="true", options={"default": null})
     */
    protected ?string $facetFilterCode = null;

    /**
     * @return string|null
     */
    public function getFacetFilterCode(): ?string
    {
        return $this->facetFilterCode;
    }

    /**
     * @param string|null $facetFilterCode
     */
    public function setFacetFilterCode(?string $facetFilterCode): void
    {
        $this->facetFilterCode = $facetFilterCode;
    }
}
