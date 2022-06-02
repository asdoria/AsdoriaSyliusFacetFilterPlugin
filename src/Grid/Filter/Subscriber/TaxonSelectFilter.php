<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber;

use Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model\DefaultFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Class TaxonSelectFilter
 * @package Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class TaxonSelectFilter implements DefaultFilterInterface
{

    public function getFilterableValueQueryBuilder(
        QueryBuilder $qb,
        FacetInterface $facet,
        string $alias,
        string $param,
        $value
    ):void
    {

        $qb->innerJoin('o.productTaxons', $alias, 'WITH', $alias . '.taxon = :' . $param)
            ->setParameter($param, $value);
    }
}
