<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model;


use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\AbstractTypeFormSubscriber;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AttributeFilterInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface AttributeFilterInterface
{
    /**
     * @param AbstractTypeFormSubscriber $subscriber
     * @param QueryBuilder               $qb
     */
    public function process(AbstractTypeFormSubscriber $subscriber, QueryBuilder $qb): void;

    /**
     * @param AbstractTypeFormSubscriber $subscriber
     *
     * @return bool
     */
    public function isSupport(AbstractTypeFormSubscriber $subscriber): bool;
}
