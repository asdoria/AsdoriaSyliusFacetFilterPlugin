<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model;


use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\AbstractTypeFormSubscriber;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AttributeFilterServiceRegistryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface AttributeFilterServiceRegistryInterface
{
    /**
     * @return array
     */
    public function all(): array;

    /**
     * @param AbstractTypeFormSubscriber $formSubscriber
     * @param QueryBuilder               $qb
     */
    public function filters(AbstractTypeFormSubscriber $formSubscriber, QueryBuilder $qb): void;
}
