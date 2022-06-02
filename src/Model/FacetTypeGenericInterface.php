<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Model;

use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Interface FacetTypeGenericInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetTypeGenericInterface extends ResourceInterface, FacetAwareInterface
{
    /**
     * @return string|null
     */
    public function getType(): ?string;

    /**
     * @param string|null $type
     */
    public function setType(?string $type): void;

    public function getResource(): ?ResourceInterface;

    public function getResourceClass(): ?string;
}
