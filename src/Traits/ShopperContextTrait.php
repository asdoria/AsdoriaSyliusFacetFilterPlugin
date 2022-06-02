<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Traits;


use Sylius\Component\Core\Context\ShopperContextInterface;
use Sylius\Component\Core\Model\ChannelInterface;
use Sylius\Component\Taxonomy\Model\TaxonInterface;

/**
 * Class ShopperContextTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
trait ShopperContextTrait
{
    protected ShopperContextInterface $shopperContext;

    /**
     * @return ShopperContextInterface
     */
    public function getShopperContext(): ShopperContextInterface
    {
        return $this->shopperContext;
    }

    /**
     * @param ShopperContextInterface $shopperContext
     */
    public function setShopperContext(ShopperContextInterface $shopperContext): void
    {
        $this->shopperContext = $shopperContext;
    }

    /**
     * @return TaxonInterface
     */
    public function getChannel(): ChannelInterface {
        return  $this->shopperContext->getChannel();
    }
}
