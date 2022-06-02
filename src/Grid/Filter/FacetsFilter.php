<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Grid\Filter;

use Asdoria\SyliusFacetFilterPlugin\Grid\Filter\Subscriber\Model\DefaultFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Sylius\Component\Registry\ServiceRegistry;
use Asdoria\SyliusFacetFilterPlugin\Repository\Model\FacetFilterRepositoryInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetFilterCodeAwareTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\QueryBuilderTrait;
use Doctrine\Common\Collections\Criteria;
use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;

/**
 * Class FacetsFilter
 * @package Asdoria\SyliusFacetFilterPlugin\Grid\Filter
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetsFilter implements FilterInterface
{
    protected ServiceRegistry $filterRegistry;
    protected FacetFilterRepositoryInterface $facetFilterRepository;
    use QueryBuilderTrait;
    use FacetFilterCodeAwareTrait;

    /**
     * @param ServiceRegistry        $filterRegistry
     * @param FacetFilterRepositoryInterface $facetFilterRepository
     */
    public function __construct(
        ServiceRegistry $filterRegistry,
        FacetFilterRepositoryInterface $facetFilterRepository
    )
    {
        $this->filterRegistry = $filterRegistry;
        $this->facetFilterRepository = $facetFilterRepository;
    }

    /**
     * @param DataSourceInterface $dataSource
     * @param string              $name
     * @param mixed               $data
     * @param array               $options
     */
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        if (empty($data) || !is_array($data)) {
            return;
        }
        $facetFilter = $this->facetFilterRepository
            ->findOneByCode($this->getFacetFilterCodeAware()->getFacetFilterCode());
        if (!$facetFilter instanceof FacetFilterInterface) return;

        $this->process(array_filter($data), $facetFilter);
    }

    /**
     * @param array                $dataValue
     * @param FacetFilterInterface $facetFilter
     */
    protected function process(array $dataValue, FacetFilterInterface $facetFilter): void
    {
        foreach ($dataValue as $code => $value) {
            $criteria = Criteria::create()->where(Criteria::expr()->eq('code', $code));
            $facet = $facetFilter->getFacets()->matching($criteria)->first();
            if (
                !$facet instanceof FacetInterface ||
                empty($value) ||
                (is_array($value) && empty(array_filter($value)))
            ) {
                if (is_array($value)) $this->process($value, $facetFilter);
                continue;
            }

            $this->getFilterableQueryBuilder($facet, $value);
        }
    }

    /**
     * @param FacetInterface $facet
     * @param                $value
     */
    protected function getFilterableQueryBuilder(FacetInterface $facet, $value): void
    {
        $code      = $facet->getCode();
        $id        = $facet->getId();
        $alias     = sprintf('%s_%s_%s', 'code', $code, $id);
        $param     = sprintf('%s_%s_%s', 'param', $code, $id);
        $filter    = $this->filterRegistry->get($facet->getFacetType()->getType());
        if (!$filter instanceof DefaultFilterInterface) {
            return;
        }

        $filter->getFilterableValueQueryBuilder($this->getQueryBuilder(), $facet, $alias, $param, $value);
    }

}
