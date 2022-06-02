<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Entity;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeGenericInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\ResourceTrait;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class FacetTypeGeneric
 * @package Asdoria\SyliusFacetFilterPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
abstract class FacetTypeGeneric implements FacetTypeGenericInterface
{
    use ResourceTrait;
    use FacetTrait;
    protected ?string $type = null;

    /**
     * @return string|null
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void
    {
        $this->type = $type;
    }

    abstract public function getResource(): ?ResourceInterface;

    /**
     * @return string|null
     */
    public function getResourceClass(): ?string {
        return $this->getResource() instanceof ResourceInterface ?
            get_class($this->getResource()) : null;
    }
}
