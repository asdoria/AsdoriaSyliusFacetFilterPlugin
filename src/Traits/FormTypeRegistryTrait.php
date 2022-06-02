<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Sylius\Bundle\ResourceBundle\Form\Registry\FormTypeRegistryInterface;

/**
 * Class FormTypeRegistryTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait FormTypeRegistryTrait
{
    protected FormTypeRegistryInterface $formTypeRegistry;

    /**
     * @return FormTypeRegistryInterface
     */
    public function getFormTypeRegistry(): FormTypeRegistryInterface
    {
        return $this->formTypeRegistry;
    }

    /**
     * @param FormTypeRegistryInterface $formTypeRegistry
     */
    public function setFormTypeRegistry(FormTypeRegistryInterface $formTypeRegistry): void
    {
        $this->formTypeRegistry = $formTypeRegistry;
    }
}
