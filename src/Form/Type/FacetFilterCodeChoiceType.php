<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type;


use Sylius\Bundle\ResourceBundle\Form\DataTransformer\ResourceToIdentifierTransformer;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\ReversedTransformer;

/**
 * Class FacetFilterChoiceType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilterCodeChoiceType extends AbstractType
{
    private RepositoryInterface $facetFilterRepository;

    public function __construct(RepositoryInterface $facetFilterRepository)
    {
        $this->facetFilterRepository = $facetFilterRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ReversedTransformer(new ResourceToIdentifierTransformer($this->facetFilterRepository, 'code')));
    }

    public function getParent(): string
    {
        return FacetFilterChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return 'asdoria_facet_filter_code_choice';
    }
}
