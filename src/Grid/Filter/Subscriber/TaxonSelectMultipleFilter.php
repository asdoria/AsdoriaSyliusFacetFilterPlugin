<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber;

use Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model\DefaultFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Class TaxonSelectMultipleFilter
 * @package Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class TaxonSelectMultipleFilter extends TaxonSelectFilter implements DefaultFilterInterface
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
        $qb
            ->innerJoin('o.productTaxons', $alias)
            ->andWhere($alias.'.taxon IN (:'.$param.')')
            ->setParameter($param, $value)
        ;
    }
}
