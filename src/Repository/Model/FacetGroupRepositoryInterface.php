<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Repository\Model;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Interface FacetGroupRepositoryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Repository\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetGroupRepositoryInterface
{
    /**
     * @param FacetGroupInterface|null $facetGroup
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder(?FacetGroupInterface $facetGroup = null): QueryBuilder;

    /**
     * {@inheritdoc}
     */
    public function findByPhrase(string $phrase, string $locale): array;
}
