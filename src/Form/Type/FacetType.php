<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Form\Type;

use Asdoria\SyliusFacetFilterPlugin\Entity\FacetGroup;
use Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber\FacetTypeSubscriber;
use Sylius\Bundle\ResourceBundle\Form\EventSubscriber\AddCodeFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Sylius\Bundle\ResourceBundle\Form\Type\ResourceTranslationsType;
use Sylius\Component\Resource\Metadata\RegistryInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FacetType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetType extends AbstractResourceType
{

    protected RegistryInterface $metadataRegistry;

    public function __construct(RegistryInterface $metadataRegistry, string $dataClass, array $validationGroups = [])
    {
        parent::__construct($dataClass, $validationGroups);
        $this->metadataRegistry = $metadataRegistry;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->addEventSubscriber(new AddCodeFormSubscriber())
            ->addEventSubscriber(new FacetTypeSubscriber($this->metadataRegistry))
            ->add('facetGroup', EntityType::class, [
                'label'    => 'asdoria.form.facet.facet_group',
                'class'    => FacetGroup::class,
                'required' => true,
            ])
            ->add('position', IntegerType::class, [
                'required'        => false,
                'label'           => 'asdoria.form.facet.position',
                'invalid_message' => 'asdoria.facet.invalid',
            ])
            ->add('translations', ResourceTranslationsType::class, [
                'entry_type' => FacetTranslationType::class,
                'label'      => 'asdoria.form.facet.translations'
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'asdoria_facet';
    }
}
