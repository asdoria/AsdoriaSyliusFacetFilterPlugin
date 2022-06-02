<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Symfony\Component\Form\FormInterface;

/**
 * Class ProductOptionSelectTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class ProductOptionSelectMultipleTypeFormSubscriber extends ProductOptionSelectTypeFormSubscriber
{
    const _IDENTIFIER = 'product_option_select_multiple';

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        return array_merge(parent::getOptions($parentForm),
            [
                'multiple'    => true,
                'placeholder' => 'asdoria.ui.placeholder_product_option_select_multiple',
                'attr'        => array_merge([
                    'class' => 'select-multiple'
                ], $this->getDataView())
            ]
        );
    }
}
