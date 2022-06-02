<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Form\Type;

use App\Entity\Product\ProductAttribute;
use Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber\TypeFacetTypeSubscriber;
use Asdoria\SyliusFacetFilterPlugin\Traits\FilterFormTypeRegistryTrait;
use Sylius\Bundle\ProductBundle\Form\Type\ProductAttributeChoiceType;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FacetTypeProductAttributeType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTypeProductAttributeType extends AbstractResourceType
{
    use FilterFormTypeRegistryTrait;
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = $this->getFilterFormTypeRegistry()->getAll()[ProductAttribute::class] ?? [];
        $builder
            ->add('productAttribute', ProductAttributeChoiceType::class, [
                'label' => 'asdoria.form.facet_type_product_attribute.product_attribute'
            ])
            ->addEventSubscriber(new TypeFacetTypeSubscriber($choices));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_facet_type_product_attribute';
    }
}
