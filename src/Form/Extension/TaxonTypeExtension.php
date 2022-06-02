<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Extension;

use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonType;

/**
 * Class FacetFilterCodeTypeExtension
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Extension
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class TaxonTypeExtension extends AbstractFacetFilterCodeTypeExtension
{
    /**
     * Gets the extended types.
     *
     * @return string[]
     */
    public static function getExtendedTypes(): iterable
    {
        return [TaxonType::class];
    }
}
