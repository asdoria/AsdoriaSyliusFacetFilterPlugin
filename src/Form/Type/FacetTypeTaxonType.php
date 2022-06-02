<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Form\Type;

use App\Entity\Taxonomy\Taxon;
use Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber\TypeFacetTypeSubscriber;
use Asdoria\SyliusFacetFilterPlugin\Traits\FilterFormTypeRegistryTrait;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\TaxonomyBundle\Form\Type\TaxonAutocompleteChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FacetTypeTaxonType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTypeTaxonType extends AbstractResourceType
{
    use FilterFormTypeRegistryTrait;
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = $this->getFilterFormTypeRegistry()->getAll()[Taxon::class] ?? [];
        $builder
            ->add('taxon', TaxonAutocompleteChoiceType::class, [
                'label' => 'asdoria.form.facet_type_taxon.taxon'
            ])
            ->addEventSubscriber(new TypeFacetTypeSubscriber($choices));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_facet_type_taxon';
    }
}
