<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters;

use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\AbstractTypeFormSubscriber;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model\AttributeFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters\Model\AttributeFilterServiceRegistryInterface;
use Doctrine\ORM\QueryBuilder;

/**
 * Class AttributeFilterServiceRegistry
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber\Filters
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeFilterServiceRegistry implements AttributeFilterServiceRegistryInterface
{
    /**
     * @var iterable
     */
    protected iterable $handlers;

    /**
     * SerializerServiceRegistry constructor.
     *
     * @param iterable $handlers
     */
    public function __construct(iterable $handlers)
    {
        $this->handlers = $handlers;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return iterator_to_array($this->handlers);
    }

    /**
     * @param AbstractTypeFormSubscriber $formSubscriber
     * @param QueryBuilder               $qb
     */
    public function filters(AbstractTypeFormSubscriber $formSubscriber, QueryBuilder $qb): void
    {
        foreach ($this->all() as $item) {
            if (!$item instanceof AttributeFilterInterface) continue;
            if (!$item->isSupport($formSubscriber)) continue;
            $item->process($formSubscriber, $qb);
        }
    }
}
