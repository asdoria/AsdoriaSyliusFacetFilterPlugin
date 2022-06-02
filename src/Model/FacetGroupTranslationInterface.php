<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Model;


use Asdoria\SyliusFacetFilterPlugin\Model\Aware\NamingAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

/**
 * Class FacetGroupTranslationInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetGroupTranslationInterface extends
    ResourceInterface,
    TranslationInterface,
    NamingAwareInterface
{

}
