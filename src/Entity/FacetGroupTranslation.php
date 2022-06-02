<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Entity;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupTranslationInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\ResourceTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\NamingTrait;
use Sylius\Component\Resource\Model\AbstractTranslation;

/**
 * Class FacetTranslation
 * @package Asdoria\SyliusFacetFilterPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetGroupTranslation  extends AbstractTranslation implements FacetGroupTranslationInterface
{
    use ResourceTrait;
    use NamingTrait;
}
