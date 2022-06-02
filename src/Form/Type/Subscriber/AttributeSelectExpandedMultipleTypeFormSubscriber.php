<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Symfony\Component\Form\FormInterface;

/**
 * Class AttributeSelectMultipleTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeSelectExpandedMultipleTypeFormSubscriber extends AttributeSelectMultipleTypeFormSubscriber
{
    const _IDENTIFIER = 'attribute_select_expanded';

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        return array_merge(parent::getOptions($parentForm),
            [
                'placeholder' => 'asdoria.ui.placeholder_attribute_select_expand',
                'expanded' => true,
                'attr' => $this->getDataView()
            ]
        );
    }
}
