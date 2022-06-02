<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Repository\Model;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * Interface FacetRepositoryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Repository\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetRepositoryInterface extends RepositoryInterface
{

    public function createQueryBuilderByFacetFilterId(string $facetFilterId): QueryBuilder;
}
