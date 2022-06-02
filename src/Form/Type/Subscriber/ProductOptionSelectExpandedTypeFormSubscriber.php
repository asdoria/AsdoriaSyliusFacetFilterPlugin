<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Symfony\Component\Form\FormInterface;

/**
 * Class ProductOptionSelectExpendedTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class ProductOptionSelectExpandedTypeFormSubscriber extends ProductOptionSelectMultipleTypeFormSubscriber
{
    const _IDENTIFIER = 'product_option_select_expanded';

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        return array_merge(parent::getOptions($parentForm),
            [
                'expanded'    => true,
                'placeholder' => 'asdoria.ui.placeholder_product_option_select_expanded',
                'attr'        => array_merge([
                    'class' => 'select-expanded'
                ], $this->getDataView())
            ]
        );
    }
}
