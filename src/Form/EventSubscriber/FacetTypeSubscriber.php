<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber;


use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Sylius\Component\Resource\Metadata\RegistryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Validator\Constraints\Valid;
use Webmozart\Assert\Assert;

/**
 * Class FacetTypeSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetTypeSubscriber implements EventSubscriberInterface
{

    protected RegistryInterface $metadataRegistry;

    public function __construct(RegistryInterface $metadataRegistry)
    {
        $this->metadataRegistry = $metadataRegistry;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $facet = $event->getData();

        /** @var $facet FacetInterface  */
        Assert::isInstanceOf($facet, FacetInterface::class);

        $type     = $facet->getFacetType();
        $classType = get_class($type);
        $metadata = $this->metadataRegistry->getByClass($classType);

        $form = $event->getForm();

        $formClass = $metadata->getClass('form');
        $form->add('facetType', $formClass, [
            'required' => true,
            'constraints' => [new Valid()],
            'label' => false
        ]);
    }
}
