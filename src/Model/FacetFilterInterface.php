<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Model;

use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetsAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\Aware\NamingAwareInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

/**
 * Class FacetInterface
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetFilterInterface extends
    ResourceInterface,
    FacetsAwareInterface,
    CodeAwareInterface,
    NamingAwareInterface
{

}
