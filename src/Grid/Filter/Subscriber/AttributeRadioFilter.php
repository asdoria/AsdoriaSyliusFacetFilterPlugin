<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber;

use Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model\DefaultFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Product\Model\ProductAttributeInterface;

/**
 * Class AttributeSelectFilter
 * @package Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeRadioFilter implements DefaultFilterInterface
{
    /**
     * @param QueryBuilder         $qb
     * @param FacetInterface $facet
     * @param string               $alias
     * @param string               $param
     * @param                      $value
     */
    public function getFilterableValueQueryBuilder(
        QueryBuilder $qb,
        FacetInterface $facet,
        string $alias,
        string $param,
        $value
    ): void
    {
        /** @var ProductAttributeInterface $productAttribute */
        $productAttribute = $facet->getFacetType()->getResource();
        $fieldType        = $productAttribute->getStorageType();

        $attrParam        = 'attr_' . uniqid($facet->getCode());
        $qb->innerJoin('o.attributes', $alias, 'WITH', $alias . '.attribute = :' . $attrParam)
            ->setParameter($attrParam, $productAttribute);

        if(is_array($value)) return;

        if ($productAttribute->getStorageType() === AttributeValueInterface::STORAGE_JSON) {
            $qb
                ->andWhere($alias . '.' . $fieldType . ' like :' . $param)
                ->setParameter($param, '%' . $value . '%');

            return;
        }

        $qb
            ->andWhere($alias . '.' . $fieldType . ' = :' . $param)
            ->setParameter($param, $value);

    }
}
