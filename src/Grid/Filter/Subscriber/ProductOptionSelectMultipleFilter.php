<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber;


use Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model\DefaultFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Class ProductOptionSelectMultipleFilter
 * @package Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class ProductOptionSelectMultipleFilter implements DefaultFilterInterface
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
    ):void
    {
        $aliasOptionValue = sprintf('%s_option_values', $alias);
        $qb
            ->innerJoin('o.variants', $alias)
            ->leftJoin($alias. '.optionValues', $aliasOptionValue)
            ->andWhere($aliasOptionValue.'.id IN (:'.$param.')')
            ->setParameter($param, $value)
        ;
    }
}
