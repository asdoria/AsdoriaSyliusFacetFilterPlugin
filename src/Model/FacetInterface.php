<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model;

use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetFilterAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetGroupAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetTypeAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\Aware\SortableAwareInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

/**
 * Class FacetInterface
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetInterface extends
    ResourceInterface,
    TranslatableInterface,
    CodeAwareInterface,
    SortableAwareInterface,
    FacetGroupAwareInterface,
    FacetFilterAwareInterface,
    FacetTypeAwareInterface
{

}
