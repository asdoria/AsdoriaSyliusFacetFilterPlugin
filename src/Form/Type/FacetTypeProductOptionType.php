<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Form\Type;

use App\Entity\Product\ProductOption;
use Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber\TypeFacetTypeSubscriber;
use Asdoria\SyliusFacetFilterPlugin\Traits\FilterFormTypeRegistryTrait;
use Sylius\Bundle\ProductBundle\Form\Type\ProductOptionChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FacetTypeProductOptionType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTypeProductOptionType extends AbstractResourceType
{
    use FilterFormTypeRegistryTrait;

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = $this->getFilterFormTypeRegistry()->getAll()[ProductOption::class] ?? [];
        $builder
            ->add('productOption', ProductOptionChoiceType::class, [
                'label' => 'asdoria.form.facet_type_product_option.product_option'
            ])
            ->addEventSubscriber(new TypeFacetTypeSubscriber($choices));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_facet_type_product_option';
    }
}
