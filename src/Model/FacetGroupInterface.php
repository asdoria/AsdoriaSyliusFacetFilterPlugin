<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Model;


use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetsAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\Aware\SortableAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Entity\FacetGroupTranslation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

/**
 * Class FacetGroupInterface
 * @package Asdoria\SyliusFacetFilterPlugin\Model
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
interface FacetGroupInterface extends
    ResourceInterface,
    TranslatableInterface,
    FacetsAwareInterface,
    CodeAwareInterface,
    SortableAwareInterface
{

    public function __toString();

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * {@inheritdoc}
     */
    public function getFullname(string $pathDelimiter = ' / '): ?string;


    /**
     * {@inheritdoc}
     */
    public function isRoot(): bool;

    /**
     * @param FacetGroupInterface $child
     */
    public function addChild(FacetGroupInterface $child): void;

    /**
     * @param FacetGroupInterface $child
     *
     * @return bool
     */
    public function hasChild(FacetGroupInterface $child) : bool;

    /**
     * @param FacetGroupInterface $child
     */
    public function removeChild(FacetGroupInterface $child): void;

    /**
     * @return Collection
     */
    public function getChildren(): Collection;

    /**
     * @return FacetGroupInterface|null
     */
    public function getParent(): ?FacetGroupInterface;

    /**
     * @param FacetGroupInterface|null $parent
     */
    public function setParent(?FacetGroupInterface $parent): void;

    /**
     * check if this item has a parent.
     *
     * @return bool
     */
    public function hasParent(): bool;

    /**
     * check if this item has children.
     *
     * @return bool
     */
    public function hasChildren(): bool;

    /**
     * {@inheritdoc}
     */
    public function getAncestors(): Collection;
}
