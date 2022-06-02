<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Sylius\Component\Taxonomy\Model\TaxonInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class TaxonSelectGroupByTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class TaxonSelectGroupByTypeFormSubscriber extends TaxonSelectTypeFormSubscriber
{
    const _IDENTIFIER = 'taxon_select_group_by';

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        return array_merge(parent::getOptions($parentForm),
            [
                'group_by' => function(TaxonInterface $choice, $key, $value) {
                        return $choice->getParent()->getName();
                }
            ]
        );
    }
}
