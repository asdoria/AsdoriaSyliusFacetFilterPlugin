<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * Class TypeFacetTypeSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\EventSubscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class TypeFacetTypeSubscriber implements EventSubscriberInterface
{

    protected array $baseChoices = [];

    public function __construct(array $baseChoices)
    {
        $this->baseChoices = $baseChoices;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    public function preSetData(FormEvent $event): void
    {
        $form = $event->getForm();
        $form->add('type', ChoiceType::class, [
            'label'         => 'asdoria.form.facet.field_type',
            'choice_loader' => new CallbackChoiceLoader(function () {
                $choices       = [];
                foreach ($this->baseChoices as $key => $value) {
                    $choices[$key] = $key;
                }
                return $choices;
            }),
            'choice_label'  => function ($choice, $key, $value) {
                return sprintf('asdoria.form.facet.field_type_%s', strtolower($key));
            }
        ]);
    }
}
