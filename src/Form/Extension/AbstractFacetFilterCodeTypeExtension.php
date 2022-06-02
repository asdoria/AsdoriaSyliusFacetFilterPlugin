<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Extension;

use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetFilterCodeChoiceType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FacetFilterCodeTypeExtension
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Extension
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
abstract class AbstractFacetFilterCodeTypeExtension extends AbstractTypeExtension
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('facetFilterCode', FacetFilterCodeChoiceType::class, [
                'required' => false,
                'multiple' => false
            ])
        ;
    }
}
