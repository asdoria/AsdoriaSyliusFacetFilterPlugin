<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Repository;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Asdoria\SyliusFacetFilterPlugin\Repository\Model\FacetGroupRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use SyliusLabs\AssociationHydrator\AssociationHydrator;

/**
 * Class FacetGroupRepository
 * @package Asdoria\SyliusFacetFilterPlugin\Repository
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetGroupRepository extends EntityRepository  implements FacetGroupRepositoryInterface
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
     * @param FacetGroupInterface|null $facetGroup
     *
     * @return QueryBuilder
     */
    public function createListQueryBuilder(?FacetGroupInterface $facetGroup = null): QueryBuilder
    {
        $qb = $this->createQueryBuilder('o');
        if (!$facetGroup instanceof FacetGroupInterface) {
            return $qb->where('o.parent IS NULL');
        }

        return $qb->where('o.parent = :facetGroup')
            ->setParameter('facetGroup', $facetGroup);
    }


    /**
     * @param string $phrase
     * @param string $locale
     *
     * @return array
     */
    public function findByPhrase(string $phrase, string $locale): array
    {
        $expr = $this->getEntityManager()->getExpressionBuilder();

        return $this->createQueryBuilder('o')
            ->innerJoin('o.translations', 'translation', 'WITH', 'translation.locale = :locale')
            ->andWhere($expr->orX(
                'translation.name LIKE :phrase',
                'o.code LIKE :phrase'
            ))
            ->setParameter('phrase', '%' . $phrase . '%')
            ->setParameter('locale', $locale)
            ->setMaxResults(100)
            ->getQuery()
            ->getResult();
    }
}
