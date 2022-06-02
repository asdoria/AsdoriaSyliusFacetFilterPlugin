<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Repository;


use Asdoria\SyliusFacetFilterPlugin\Repository\Model\FacetRepositoryInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * Class FacetFilterRepository
 * @package Asdoria\SyliusFacetFilterPlugin\Repository
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetRepository extends EntityRepository  implements FacetRepositoryInterface
{


    public function createQueryBuilderByFacetFilterId(string $facetFilterId): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        $qb->andWhere('o.facetFilter = :facetFilter')
            ->setParameter('facetFilter', $facetFilterId);
        return $qb;
    }

}
