<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Entity;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetTranslationInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\ResourceTrait;
use Sylius\Component\Resource\Model\AbstractTranslation;

/**
 * Class FacetTranslation
 * @package Asdoria\SyliusFacetFilterPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTranslation  extends AbstractTranslation implements FacetTranslationInterface
{
    use ResourceTrait;

    /** @var string|null */
    protected ?string $title;

    /** @var string|null */
    protected ?string $description;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

}
