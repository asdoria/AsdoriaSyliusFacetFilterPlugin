<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Traits;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;

/**
 * Trait ChannelTrait
 * @package Asdoria\SyliusFacetFilterPlugin\Traits
 */
trait ChannelsTrait
{
    /**
     * @var Collection
     */
    protected Collection $channels;

    /**
     *
     */
    protected function initializeChannels(): void
    {
        $this->channels = new ArrayCollection();
    }

    /**
     * @return Collection
     */
    public function getChannels(): Collection
    {
        return $this->channels;
    }

    /**
     * @param ChannelInterface|null $channel
     */
    public function addChannel(?ChannelInterface $channel): void
    {
        if (!$this->hasChannel($channel)) {
            $this->channels->add($channel);
        }
    }

    /**
     * @param ChannelInterface|null $channel
     */
    public function removeChannel(?ChannelInterface $channel): void
    {
        if ($this->hasChannel($channel)) {
            $this->channels->removeElement($channel);
        }
    }

    /**
     * @param ChannelInterface|null $channel
     *
     * @return bool
     */
    public function hasChannel(?ChannelInterface $channel): bool
    {
        return $this->channels->contains($channel);
    }
}
