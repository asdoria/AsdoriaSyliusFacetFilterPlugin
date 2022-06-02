<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Entity;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetTranslationInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\CodeTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetFilterTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetGroupTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetTypeTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\ResourceTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\SortableTrait;
use Sylius\Component\Resource\Model\TranslatableTrait;

/**
 * Class Facet
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
class Facet implements FacetInterface
{
    use ResourceTrait;
    use FacetFilterTrait;
    use CodeTrait;
    use SortableTrait;
    use FacetGroupTrait;
    use FacetTypeTrait;
    use TranslatableTrait {
        TranslatableTrait::__construct as private initializeTranslationsCollection;
        TranslatableTrait::getTranslation as private doGetTranslation;
    }


    public function getTitle(): ?string {
        return $this->getTranslation()->getTitle();
    }

    /**
     * MatrixFacet constructor.
     */
    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }


    /**
     * @return FacetTranslationInterface
     */
    protected function createTranslation(): FacetTranslationInterface
    {
        return new FacetTranslation();
    }
}
