<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\EventListener;


use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetFilterCodeAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\EntityManagerTrait;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;

/**
 * Class DataSourceEvent
 * @package Asdoria\SyliusFacetFilterPlugin\EventListener
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilterEventListener
{

    use EntityManagerTrait;

    public function processPreDelete(ResourceControllerEvent $event) {
        $subject = $event->getSubject();

        if (!$subject instanceof FacetFilterInterface) return;

        $all = $this->getEntityManager()->getMetadataFactory()->getAllMetadata();

        foreach ($all as $metadata) {
            $class = $metadata->getName();
            $reflClass = new \ReflectionClass($class);
            if (!$reflClass->implementsInterface(FacetFilterCodeAwareInterface::class)) continue;

            $resources = $this->getEntityManager()->getRepository($class)->findBy(['facetFilterCode' => $subject->getCode()]);
            /** @var  FacetFilterCodeAwareInterface $resource */
            foreach ($resources as $resource) $resource->setFacetFilterCode(null);
        }
    }
}
