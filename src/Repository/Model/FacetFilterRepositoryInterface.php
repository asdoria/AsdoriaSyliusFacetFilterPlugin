<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Repository\Model;



use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * Interface FacetFilterRepositoryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Repository\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetFilterRepositoryInterface extends RepositoryInterface
{

    /**
     * @return QueryBuilder
     */
    public function createListQueryBuilder(): QueryBuilder;
}
