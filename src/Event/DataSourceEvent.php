<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Event;

use Asdoria\SyliusFacetFilterPlugin\Event\Model\DataSourceEventInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Grid\Parameters;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Class DataSourceEvent
 * @package Asdoria\SyliusFacetFilterPlugin\Event
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class DataSourceEvent extends Event implements DataSourceEventInterface
{
    /**
     * @var QueryBuilder
     */
    protected QueryBuilder $queryBuilder;
    /**
     * @var Parameters
     */
    protected Parameters $parameters;

    /**
     * DataSourceEvent constructor.
     *
     * @param QueryBuilder $queryBuilder
     * @param Parameters   $parameters
     */
    public function __construct(QueryBuilder $queryBuilder, Parameters $parameters) {
        $this->queryBuilder = $queryBuilder;
        $this->parameters = $parameters;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }

    /**
     * @return Parameters
     */
    public function getParameters(): Parameters
    {
        return $this->parameters;
    }
}
