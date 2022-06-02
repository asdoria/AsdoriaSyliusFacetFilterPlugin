<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Symfony\Component\Form\FormInterface;

/**
 * Class TaxonSelectMultipleTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class TaxonSelectExpandedTypeFormSubscriber extends TaxonSelectMultipleTypeFormSubscriber
{
    const _IDENTIFIER = 'taxon_select_expanded';

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        return array_merge(parent::getOptions($parentForm),
            [
             'expanded' => true,
             'attr' => array_merge(['class' => 'select-expanded'], $this->getDataView())
            ]
        );
    }
}
