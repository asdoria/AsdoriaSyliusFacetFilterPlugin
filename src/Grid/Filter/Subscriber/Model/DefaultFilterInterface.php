<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Interface DefaultFilterInterface
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
interface DefaultFilterInterface
{
    /**
     * @param QueryBuilder   $qb
     * @param FacetInterface $facet
     * @param string         $alias
     * @param string         $param
     * @param                $value
     */
    public function getFilterableValueQueryBuilder(
        QueryBuilder $qb,
        FacetInterface $facet,
        string $alias,
        string $param,
        $value): void;
}
