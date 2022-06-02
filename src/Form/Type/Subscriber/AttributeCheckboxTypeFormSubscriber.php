<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormInterface;

/**
 * Class AttributeCheckboxTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeCheckboxTypeFormSubscriber  extends AbstractTypeFormSubscriber
{
    const _IDENTIFIER = 'attribute_checkbox';

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return CheckboxType::class;
    }

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        return array_merge(
            parent::getOptions($parentForm),
            [
             'label_attr' => ['class' => 'label-checkbox'],
             'attr'       => array_merge(['class' => 'input-checkbox'], $this->getDataView()),
             'data'       => false
            ]
        );
    }
}
