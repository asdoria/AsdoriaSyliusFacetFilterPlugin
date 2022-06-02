<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters;


use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\AbstractTypeFormSubscriber;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model\AttributeFilterInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Product\Model\ProductAttributeInterface;
use Sylius\Component\Taxonomy\Model\TaxonsAwareInterface;

/**
 * Class AttributeFilterByOwnerAndTaxonsAware
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeFilterByOwnerAndTaxonsAware  implements AttributeFilterInterface
{

    /**
     * @param AbstractTypeFormSubscriber $subscriber
     * @param QueryBuilder               $qb
     */
    public function process(AbstractTypeFormSubscriber $subscriber, QueryBuilder $qb): void
    {
        $rootAlias = $subscriber->getQueryBuilder()->getRootAliases()[0] ?? 'o';
        /** @var TaxonsAwareInterface $owner */
        $owner = $subscriber->getOwner();

        $qb
            ->innerJoin($rootAlias . '.productTaxons', 'productTaxons', 'with', 'productTaxons.taxon in (:currentTaxons)')
            ->setParameter('currentTaxons', $owner->getTaxons());
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
        if (!$subscriber->getOwner() instanceof TaxonsAwareInterface) return false;

        return $subscriber->isFilterByOwner();
    }
}
