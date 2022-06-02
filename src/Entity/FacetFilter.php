<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Entity;



use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\CodeTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetsTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\NamingTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\ResourceTrait;

/**
 * Class Facet
 *
 * @author Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilter implements FacetFilterInterface
{
    use ResourceTrait;
    use FacetsTrait;
    use CodeTrait;
    use NamingTrait;

    /**
     * MatrixFacet constructor.
     */
    public function __construct()
    {
        $this->initializeFacetsCollection();
    }

    public function __toString()
    {
        return $this->getCode();
    }
}
