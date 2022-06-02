<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Entity;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupTranslationInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\CodeTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetsTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\ResourceTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\SortableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\TranslatableTrait;

/**
 * Class FacetGroup
 * @package Asdoria\SyliusFacetFilterPlugin\Entity
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetGroup implements FacetGroupInterface
{
    use ResourceTrait;
    use CodeTrait;
    use FacetsTrait;
    use SortableTrait;
    use TranslatableTrait {
        TranslatableTrait::__construct as private initializeTranslationsCollection;
        TranslatableTrait::getTranslation as private doGetTranslation;
    }

    /**
     * @var Collection| FacetGroupInterface(]
     */
    private Collection $children;

    /**
     * @var FacetGroupInterface|null
     */
    private ?FacetGroupInterface $parent = null;

    /**
     * MatrixFacet constructor.
     */
    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->initializeTranslationsCollection();
        $this->initializeFacetsCollection();
    }

    public function __toString()
    {
        return $this->getFullname();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    /**
     * {@inheritdoc}
     */
    public function getFullname(string $pathDelimiter = ' / '): ?string
    {
        if ($this->isRoot()) {
            return $this->getName();
        }

        return sprintf(
            '%s%s%s',
            $this->getParent()->getFullname(),
            $pathDelimiter,
            $this->getName()
        );
    }


    /**
     * {@inheritdoc}
     */
    public function isRoot(): bool
    {
        return null === $this->parent;
    }

    /**
     * @return FacetGroupTranslationInterface
     */
    protected function createTranslation(): FacetGroupTranslationInterface
    {
        return new FacetGroupTranslation();
    }

    /**
     * @param FacetGroupInterface $child
     */
    public function addChild(FacetGroupInterface $child): void
    {
        if ($this->hasChild($child)) {
            return;
        }

        $child->setParent($this);
        $this->children->add($child);
    }

    /**
     * @param FacetGroupInterface $child
     *
     * @return bool
     */
    public function hasChild(FacetGroupInterface $child) : bool {
        return $this->children->contains($child);
    }

    /**
     * @param FacetGroupInterface $child
     */
    public function removeChild(FacetGroupInterface $child): void
    {
        if (!$this->hasChild($child)) {
            return;
        }

        $this->children->removeElement($child);

        $child->setParent(null);
    }

    /**
     * @return Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @return FacetGroupInterface|null
     */
    public function getParent(): ?FacetGroupInterface
    {
        return $this->parent;
    }

    /**
     * @param FacetGroupInterface|null $parent
     */
    public function setParent(?FacetGroupInterface $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * check if this item has a parent.
     *
     * @return bool
     */
    public function hasParent(): bool {
        return $this->getParent() instanceof FacetGroupInterface;
    }

    /**
     * check if this item has children.
     *
     * @return bool
     */
    public function hasChildren(): bool
    {
        return $this->children->count() > 0;
    }


    /**
     * {@inheritdoc}
     */
    public function getAncestors(): Collection
    {
        $ancestors = [];

        for ($ancestor = $this->getParent(); null !== $ancestor; $ancestor = $ancestor->getParent()) {
            $ancestors[] = $ancestor;
        }

        return new ArrayCollection($ancestors);
    }

}
