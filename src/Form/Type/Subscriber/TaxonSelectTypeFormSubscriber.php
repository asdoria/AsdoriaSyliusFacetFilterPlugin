<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use App\Entity\Taxonomy\Taxon;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\ProductTaxonFilterType;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeTaxonInterface;
use Symfony\Component\Form\FormInterface;

/**
 * Class TaxonSelectTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class TaxonSelectTypeFormSubscriber  extends AbstractTypeFormSubscriber
{
    const _IDENTIFIER = 'taxon_select';

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ProductTaxonFilterType::class;
    }

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        $facetType = $this->getFacet()->getFacetType();
        if (!$facetType instanceof FacetTypeTaxonInterface) {
            throw new \InvalidArgumentException('invalid facet type');
        }

        return array_merge(parent::getOptions($parentForm),
            [
                'parentCode' => $facetType->getTaxon()->getCode(),
                'class'      => Taxon::class,
                'attr'       => array_merge(['class' => 'mySelect'], $this->getDataView())
            ]
        );
    }
}
