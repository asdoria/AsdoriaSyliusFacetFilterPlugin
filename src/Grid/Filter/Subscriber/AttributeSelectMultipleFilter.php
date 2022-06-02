<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber;

use Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model\DefaultFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;

/**
 * Class AttributeSelectMultipleFilter
 * @package Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeSelectMultipleFilter extends AttributeSelectFilter implements DefaultFilterInterface
{
    /**
     * @param QueryBuilder         $qb
     * @param FacetInterface       $facet
     * @param string               $alias
     * @param string               $param
     * @param                      $value
     */
    public function getFilterableValueQueryBuilder(
        QueryBuilder   $qb,
        FacetInterface $facet,
        string         $alias,
        string         $param,
                       $value
    ): void
    {
        /** @var ProductAttributeInterface $productAttribute */
        $productAttribute = $facet->getFacetType()->getResource();
        $fieldType        = $productAttribute->getStorageType();
        $parameters       = [];

        if (!is_array($value)) return;

        foreach ($value as $k => $v) {
            $p = sprintf(':%s%s', $param, $k);
            $a = sprintf('%s.%s', $alias, $fieldType);

            if ($productAttribute->getStorageType() === AttributeValueInterface::STORAGE_JSON) {
                $ors[]          = $qb->expr()->like($a, $p);
                $parameters[$p] = '%' . $v . '%';

                continue;
            }

            $ors[]          = $qb->expr()->eq($a, $p);
            $parameters[$p] = $v;
        }

        $isMultiple = $productAttribute->getConfiguration()['multiple'] ?? false;
        $attrParam  = 'attr_' . uniqid($facet->getCode());
        $qb->innerJoin('o.attributes', $alias, 'WITH', $alias . '.attribute = :' . $attrParam)
            ->setParameter($attrParam, $productAttribute)
            ->andWhere($isMultiple ? $qb->expr()->orX(...$ors) : $qb->expr()->andX(...$ors));

        foreach ($parameters as $key => $d) {
            $qb->setParameter($key, $d);
        }
    }
}
