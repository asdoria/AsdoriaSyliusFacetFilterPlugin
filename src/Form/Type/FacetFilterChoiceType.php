<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Bridge\Doctrine\Form\DataTransformer\CollectionToArrayTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class FacetFilterChoiceType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilterChoiceType extends AbstractType
{
    private RepositoryInterface $facetFilterRepository;

    public function __construct(RepositoryInterface $facetFilterRepository)
    {
        $this->facetFilterRepository = $facetFilterRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CollectionToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver
            ->setDefaults([
                'choice_filter' => null,
                'choices' => fn (Options $options): iterable => $this->facetFilterRepository->findAll(),
                'choice_value' => 'code',
                'choice_label' => 'name',
                'choice_translation_domain' => false,
                'enabled' => true,
                'label' => 'asdoria.form.facet_filter_code.label',
                'placeholder' => 'asdoria.form.facet_filter_code.selected',
            ])
            ->setAllowedTypes('choice_filter', ['null', 'callable'])
            ->setNormalizer('choices', static function (Options $options, array $facetFilters): array {
                if ($options['choice_filter']) {
                    $facetFilters = array_filter($facetFilters, $options['choice_filter']);
                }

                usort($facetFilters, static fn(FacetFilterInterface $firstFacetFilter, FacetFilterInterface $secondFacetFilter): int => $firstFacetFilter->getName() <=> $secondFacetFilter->getName());

                return $facetFilters;
            })
        ;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'asdoria_facet_filter_choice';
    }
}
