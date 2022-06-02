<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\DependencyInjection;

use Asdoria\SyliusFacetFilterPlugin\Controller\FacetController;
use Asdoria\SyliusFacetFilterPlugin\Controller\FacetGroupController;
use Asdoria\SyliusFacetFilterPlugin\Entity\Facet;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetFilter;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetGroup;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetGroupTranslation;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTranslation;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeGeneric;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeProductAttribute;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeProductOption;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTypeTaxon;
use Asdoria\SyliusFacetFilterPlugin\Factory\FacetFactory;
use Asdoria\SyliusFacetFilterPlugin\Factory\FacetFilterFactory;
use Asdoria\SyliusFacetFilterPlugin\Factory\FacetGroupFactory;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetFilterType;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetGroupTranslationType;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetGroupType;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetTranslationType;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetType;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetTypeProductAttributeType;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetTypeProductOptionType;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\FacetTypeTaxonType;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Asdoria\SyliusFacetFilterPlugin\Repository\FacetFilterRepository;
use Asdoria\SyliusFacetFilterPlugin\Repository\FacetGroupRepository;
use Asdoria\SyliusFacetFilterPlugin\Repository\FacetRepository;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Asdoria\SyliusFacetFilterPlugin\DependencyInjection
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('asdoria_facet_filter');
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->addDefaultsIfNotSet()
                ->children()
                ->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)
            ->end();
        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }


    private function addResourcesSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('facet_filter')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(FacetFilter::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(FacetFilterRepository::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(FacetFilterFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(FacetFilterType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('facet')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(Facet::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(FacetController::class)->cannotBeEmpty()->end()
                                        ->scalarNode('repository')->defaultValue(FacetRepository::class)->cannotBeEmpty()->end()
                                        ->scalarNode('factory')->defaultValue(FacetFactory::class)->end()
                                        ->scalarNode('form')->defaultValue(FacetType::class)->cannotBeEmpty()->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                        ->addDefaultsIfNotSet()
                                        ->children()
                                            ->scalarNode('model')->defaultValue(FacetTranslation::class)->cannotBeEmpty()->end()
                                            ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                            ->scalarNode('repository')->cannotBeEmpty()->end()
                                            ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                            ->scalarNode('form')->defaultValue(FacetTranslationType::class)->cannotBeEmpty()->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->end()
                        ->arrayNode('facet_group')
                            ->addDefaultsIfNotSet()
                            ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(FacetGroup::class)->cannotBeEmpty()->end()
                                    ->scalarNode('interface')->defaultValue(FacetGroupInterface::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(FacetGroupController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->defaultValue(FacetGroupRepository::class)->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(FacetGroupFactory::class)->end()
                                    ->scalarNode('form')->defaultValue(FacetGroupType::class)->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                            ->arrayNode('translation')
                                ->addDefaultsIfNotSet()
                                ->children()
                                ->variableNode('options')->end()
                                    ->arrayNode('classes')
                                        ->addDefaultsIfNotSet()
                                        ->children()
                                            ->scalarNode('model')->defaultValue(FacetGroupTranslation::class)->cannotBeEmpty()->end()
                                            ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                            ->scalarNode('repository')->cannotBeEmpty()->end()
                                            ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                            ->scalarNode('form')->defaultValue(FacetGroupTranslationType::class)->cannotBeEmpty()->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('facet_type_taxon')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(FacetTypeTaxon::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->scalarNode('form')->defaultValue(FacetTypeTaxonType::class)->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('facet_type_product_attribute')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(FacetTypeProductAttribute::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->scalarNode('form')->defaultValue(FacetTypeProductAttributeType::class)->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('facet_type_product_option')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(FacetTypeProductOption::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                    ->scalarNode('form')->defaultValue(FacetTypeProductOptionType::class)->cannotBeEmpty()->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('facet_type_generic')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->variableNode('options')->end()
                            ->arrayNode('classes')
                                ->addDefaultsIfNotSet()
                                ->children()
                                    ->scalarNode('model')->defaultValue(FacetTypeGeneric::class)->cannotBeEmpty()->end()
                                    ->scalarNode('controller')->defaultValue(ResourceController::class)->cannotBeEmpty()->end()
                                    ->scalarNode('repository')->cannotBeEmpty()->end()
                                    ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
            ->end();
    }

}
