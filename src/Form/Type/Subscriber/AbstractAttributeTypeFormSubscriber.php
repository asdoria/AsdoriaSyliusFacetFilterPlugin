<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\AttributeFilterServiceRegistryTrait;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\FormInterface;

/**
 * Class AbstractAttributeTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
abstract class AbstractAttributeTypeFormSubscriber extends AbstractTypeFormSubscriber
{
    use AttributeFilterServiceRegistryTrait;

    /**
     * @param QueryBuilder   $qb
     * @param FacetInterface $facet
     * @param FormInterface  $parentForm
     *
     * @return array
     */
    protected function getChoicesResult(QueryBuilder $qb, FacetInterface $facet, FormInterface $parentForm): array
    {
        $attribute     = $this->getFacet()->getFacetType()->getResource();
        $selectedValue = $this->getSelectedValue($facet, $parentForm);
        $storage       = $attribute->getStorageType();
        $localeCode    = $attribute->getTranslation()->getLocale();

        try {
            $choices = $qb->getQuery()->getResult();
        } catch (\Throwable $e) {
            $choices = [];
        }

        /** SelectColorAttributeType::TYPE */
        $result = [];
        foreach ($choices as $item) {
            $values = $item[$storage] ?? [];
            if (!is_array($values)) $values = [$values];

            foreach ($values as $choice) {
                $configurationChoice = $attribute->getConfiguration()['choices'][$choice] ?? [];
                $value               = $configurationChoice[$localeCode] ?? null;
                $keyValue            = !empty($value) ? $value : strval($choice);
                $result[$keyValue]   = $choice;
            }
        }

        ksort($result);
        $choices = $attribute->getConfiguration()['choices'] ?? [];
        if ($this->isFilterByFunnel() &&
            !empty($selectedValue) && !in_array($selectedValue, $result) && !empty($choices)) {

            if (!is_array($selectedValue)) $selectedValue = [$selectedValue];

            foreach ($selectedValue as $val) {
                $configurationChoice = $choices[$val] ?? [];
                $value               = $configurationChoice[$localeCode] ?? null;
                if (!empty($value))
                    $result[$value] = $val;
            }
        }

        return $result;
    }

    /**
     * @param FacetInterface $facet
     * @param FormInterface        $parentForm
     *
     * @return mixed|null
     */
    protected function getSelectedValue(FacetInterface $facet, FormInterface $parentForm)
    {
        $request = $this->getRequest();
        $criteria = $request->query->all('criteria');
        $groups   = $this->getGroups($parentForm);
        foreach ($groups as $group) {
            $criteria = $criteria[$group] ?? [];
        }

        return $criteria[$facet->getCode()] ?? null;
    }
}
