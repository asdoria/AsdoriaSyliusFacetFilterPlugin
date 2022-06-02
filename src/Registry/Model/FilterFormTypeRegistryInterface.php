<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Registry\Model;


use Sylius\Bundle\ResourceBundle\Form\Registry\FormTypeRegistryInterface;

/**
 * Class FilterFormTypeRegistryInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Registry\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FilterFormTypeRegistryInterface extends FormTypeRegistryInterface
{
    /**
     * @return array
     */
    public function getAll() : array;
}
