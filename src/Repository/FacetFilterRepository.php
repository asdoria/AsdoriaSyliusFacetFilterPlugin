<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Repository;


use Asdoria\SyliusFacetFilterPlugin\Repository\Model\FacetFilterRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use SyliusLabs\AssociationHydrator\AssociationHydrator;

/**
 * Class FacetFilterRepository
 * @package Asdoria\SyliusFacetFilterPlugin\Repository
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilterRepository extends EntityRepository  implements FacetFilterRepositoryInterface
{
    /** @var AssociationHydrator */
    private AssociationHydrator $associationHydrator;

    /**
     * {@inheritdoc}
     */
    public function __construct(EntityManager $entityManager, ClassMetadata $class)
    {
        parent::__construct($entityManager, $class);

        $this->associationHydrator = new AssociationHydrator($entityManager, $class);
    }

    /**
     * @return QueryBuilder
     */
    public function createListQueryBuilder(): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        return $qb;
    }

}
