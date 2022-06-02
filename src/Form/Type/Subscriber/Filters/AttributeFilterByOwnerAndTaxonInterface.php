<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters;


use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\AbstractTypeFormSubscriber;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model\AttributeFilterInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Model\TaxonInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Taxonomy\Model\TaxonsAwareInterface;

/**
 * Class AttributeFilterByOwnerAndTaxonInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeFilterByOwnerAndTaxonInterface  implements AttributeFilterInterface
{

    /**
     * @param AbstractTypeFormSubscriber $subscriber
     * @param QueryBuilder               $qb
     */
    public function process(AbstractTypeFormSubscriber $subscriber, QueryBuilder $qb): void
    {
        $rootAlias = $subscriber->getQueryBuilder()->getRootAliases()[0] ?? 'o';
        /** @var TaxonInterface $owner */
        $owner = $subscriber->getOwner();

        $qb
            ->innerJoin($rootAlias . '.productTaxons', 'productTaxons', 'with', 'productTaxons.taxon = :currentTaxon')
            ->setParameter('currentTaxon', $owner);
    }

    /**
     * @param AbstractTypeFormSubscriber $subscriber
     *
     * @return bool
     */
    public function isSupport(AbstractTypeFormSubscriber $subscriber): bool
    {
        $attribute = $subscriber->getFacet()->getFacetType()->getResource();

        if (!$attribute instanceof ProductAttributeInterface) return false;
        if (!$subscriber->getOwner() instanceof TaxonInterface) return false;

        return $subscriber->isFilterByOwner();
    }
}
