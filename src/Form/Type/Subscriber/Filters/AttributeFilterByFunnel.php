<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters;


use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\AbstractTypeFormSubscriber;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model\AttributeFilterInterface;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query\Parameter;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Product\Model\ProductAttributeInterface;

/**
 * Class AttributeFilterByFunnel
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeFilterByFunnel implements AttributeFilterInterface
{

    /**
     * @param AbstractTypeFormSubscriber $subscriber
     * @param QueryBuilder               $qb
     */
    public function process(AbstractTypeFormSubscriber $subscriber, QueryBuilder $qb): void {
        $attribute = $subscriber->getFacet()->getFacetType()->getResource();
        $rootAlias = $subscriber->getQueryBuilder()->getRootAliases()[0] ?? 'o';
        $joins     = $subscriber->getQueryBuilder()->getDQLPart('join')[$rootAlias] ?? [];
        $wheres    = $subscriber->getQueryBuilder()->getDQLPart('where');

        $qb->andWhere($wheres);
        /** @var Join $join */
        foreach ($joins as $join) {
            $qb->join($join->getJoin(), $join->getAlias(), $join->getConditionType(), $join->getCondition());
        }

        $availableParams = $subscriber->getQueryBuilder()->getParameters()->filter(fn(Parameter $p) => !$attribute->isTranslatable() || $p->getName() !== ':localeCode');
        $qb
            ->setParameters($availableParams)
            ->setParameter('attribute', $attribute);
    }

    /**
     * @param AbstractTypeFormSubscriber $subscriber
     *
     * @return bool
     */
    public function isSupport(AbstractTypeFormSubscriber $subscriber):bool {
        $attribute = $subscriber->getFacet()->getFacetType()->getResource();

        if(!$attribute instanceof ProductAttributeInterface) return false;

        return $subscriber->isFilterByFunnel();
    }
}
