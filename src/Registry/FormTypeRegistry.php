<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Registry;

use Asdoria\SyliusFacetFilterPlugin\Registry\Model\FilterFormTypeRegistryInterface;

/**
 * Class FormTypeRegistry
 * @package Asdoria\SyliusFacetFilterPlugin\Registry
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FormTypeRegistry implements FilterFormTypeRegistryInterface
{
    /** @var array|string[][] */
    protected array $formTypes = [];

    /**
     * @return array
     */
    public function getAll() : array {
        return $this->formTypes;
    }

    /**
     * {@inheritdoc}
     */
    public function add(string $identifier, string $typeIdentifier, string $formType): void
    {
        $this->formTypes[$identifier][$typeIdentifier] = $formType;
    }

    /**
     * {@inheritdoc}
     */
    public function get(string $identifier, string $typeIdentifier): ?string
    {
        if (!$this->has($identifier, $typeIdentifier)) {
            return null;
        }

        return $this->formTypes[$identifier][$typeIdentifier];
    }

    /**
     * {@inheritdoc}
     */
    public function has(string $identifier, string $typeIdentifier): bool
    {
        return isset($this->formTypes[$identifier][$typeIdentifier]);
    }
}
