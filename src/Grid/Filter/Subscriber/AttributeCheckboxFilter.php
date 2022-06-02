<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber;

use Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model\DefaultFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Product\Model\ProductAttributeInterface;

/**
 * Class AttributeCheckboxFilter
 * @package Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeCheckboxFilter implements DefaultFilterInterface
{
    public function getFilterableValueQueryBuilder(
        QueryBuilder $qb,
        FacetInterface $facet,
        string $alias,
        string $param,
        $value
    ):void
    {
        /** @var ProductAttributeInterface $productAttribute */
        $productAttribute = $facet->getFacetType()->getResource();
        $type      = $productAttribute->getStorageType();
        $attrParam = 'attr_' . uniqid($facet->getCode());
        $qb->innerJoin('o.attributes', $alias, 'WITH', $alias . '.attribute = :' . $attrParam)
            ->setParameter($attrParam, $productAttribute)
            ->andWhere($alias . '.'.$type.' = :' . $param)
            ->setParameter($param, $value);
    }
}
