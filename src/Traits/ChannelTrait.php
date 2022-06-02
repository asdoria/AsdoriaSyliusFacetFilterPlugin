<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Traits;

use Sylius\Component\Channel\Model\ChannelInterface;

/**
 * Trait ChannelTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 */
trait ChannelTrait
{
    /**
     * @var ChannelInterface|null
     */
    protected $channel;

    /**
     * @return ChannelInterface|null
     */
    public function getChannel(): ?ChannelInterface
    {
        return $this->channel;
    }

    /**
     * @param ChannelInterface|null $channel
     */
    public function setChannel(?ChannelInterface $channel): void
    {
        $this->channel = $channel;
    }
}
