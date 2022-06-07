<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeProductOptionInterface;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Product\Model\ProductOptionValueInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;

/**
 * Class ProductOptionSelectTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class ProductOptionSelectTypeFormSubscriber extends AbstractTypeFormSubscriber
{
    const _IDENTIFIER = 'product_option_select';

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ChoiceType::class;
    }

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        return array_merge(parent::getOptions($parentForm),
            [
                'choices'       => $this->getChoiceValues(),
                'choice_label'  => function (ProductOptionValueInterface $choice, $key, $value)  {
                    return $choice->getTranslation()->getValue();
                },
                'choice_value' => 'id',
                'placeholder'   => sprintf('asdoria.ui.placeholder_%s', self::_IDENTIFIER),
                'attr'          => array_merge([
                    'class' => 'mySelect'
                ], $this->getDataView())
            ]);
    }

    /**
     * @return Collection
     */
    protected function getChoiceValues(): Collection
    {
        $facetType     = $this->getFacet()->getFacetType();
        if (!$facetType instanceof FacetTypeProductOptionInterface) {
            throw new \InvalidArgumentException('invalid facet type FacetTypeProductOptionInterface');
        }

        return $facetType->getProductOption()->getValues();
    }
}
