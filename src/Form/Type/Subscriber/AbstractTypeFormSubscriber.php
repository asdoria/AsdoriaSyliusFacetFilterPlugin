<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;


use Asdoria\SyliusFacetFilterPlugin\Entity\FacetTranslation;
use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetFilterAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\EntityManagerTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\QueryBuilderTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\RequestStackTrait;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Locale\Model\LocaleInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class AbstractTypeFormSubscriber
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
abstract class AbstractTypeFormSubscriber implements EventSubscriberInterface
{
    use QueryBuilderTrait;
    use RequestStackTrait;
    use EntityManagerTrait;
    protected FacetInterface $facet;
    protected ?FacetFilterAwareInterface $owner = null;
    protected ?string $localeCode = null;
    protected array $filterOptions;
    protected ResourceInterface $resource;

    /**
     * @param FacetInterface    $facet
     * @param RequestStack      $requestStack
     * @param QueryBuilder      $queryBuilder
     * @param ResourceInterface $resource
     * @param string            $localeCode
     * @param array             $filterOptions
     */
    public function __construct(
        FacetInterface $facet,
        RequestStack $requestStack,
        QueryBuilder $queryBuilder,
        ResourceInterface $resource,
        string $localeCode,
        array $filterOptions
    )
    {
        $this->facet         = $facet;
        $this->localeCode    = $localeCode;
        $this->filterOptions = $filterOptions;
        $this->resource      = $resource;
        $this->setQueryBuilder($queryBuilder);
        $this->setEntityManager($queryBuilder->getEntityManager());
        $this->setRequestStack($requestStack);
    }

    /**
     * @return string
     */
    public function getLocaleCode(): string
    {
        return $this->localeCode;
    }

    /**
     * @return ResourceInterface
     */
    public function getOwner(): ResourceInterface
    {
        return $this->resource;
    }

    /**
     * @return array
     */
    public function getFilterOptions(): array
    {
        return $this->filterOptions;
    }

    /**
     * @return bool
     */
    public function isFilterByFunnel():bool {
        return ($this->getFilterOptions()['filterBy'] ?? '') === 'funnel';
    }

    /**
     * @return bool
     */
    public function isFilterByOwner():bool {
        return ($this->getFilterOptions()['filterBy'] ?? '') === 'owner';
    }

    /**
     * @param array $filterOptions
     */
    public function setFilterOptions(array $filterOptions): void
    {
        $this->filterOptions = $filterOptions;
    }

    /**
     * @return FacetInterface
     */
    public function getFacet(): FacetInterface
    {
        return $this->facet;
    }

    /**
     * @param FormEvent $event
     */
    public function preSetData(FormEvent $event): void
    {
        $facet  = $this->getFacet();
        $parentForm   = $this->findForm($event->getForm(), $facet->getFacetGroup());
        $parentForm->add(
            $facet->getCode(),
            $this->getFormType(),
            $this->getOptions($parentForm)
        );
    }

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        /** @var FacetTranslation $trans */
        $trans = $this->getFacet()->getTranslation($this->getLocaleCode());
        return [
            'label'       => $trans instanceof FacetTranslation ? $trans->getTitle() : null,
            'label_attr'  => [
                'data-label-placeholder' => $trans instanceof FacetTranslation ? $trans->getDescription() : null
            ],
            'row_attr'    => [
                'readable'      => true,
                'default_value' => $this->getDefaultValue()
            ],
            'attr' => $this->getDataView()
        ];
    }

    /**
     * @return array
     */
    protected function getDataView(): array  {
        return [];
    }

    /**
     * @return string|null
     */
    protected function getDefaultValue(): ?string
    {
        return null;
    }

    /**
     * @return string
     */
    abstract function getFormType(): string;

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SET_DATA => 'preSetData',
        ];
    }

    /**
     * @param FormInterface             $form
     * @param FacetGroupInterface $facetGroup
     *
     * @return FormInterface
     */
    protected function findForm(FormInterface $form, FacetGroupInterface $facetGroup): FormInterface
    {

        if ($facetGroup->getAncestors()->isEmpty()) {
            return $form->get($facetGroup->getCode());
        }

        $ancestors = array_reverse($facetGroup->getAncestors()->getValues());
        foreach ($ancestors as $ancestor) {
            $form = $this->findForm($form, $ancestor);
        }

        return $form->get($facetGroup->getCode());
    }

    /**
     * @return array
     */
    protected function getLocalesCode(): array
    {
        $localesCode      = [];
        $availableLocales = $this->getEntityManager()->getRepository(LocaleInterface::class)->findAll();
        /** @var LocaleInterface $availableLocale */
        foreach ($availableLocales as $availableLocale) {
            $localesCode[$availableLocale->getCode()] = $availableLocale->getCode();
        }

        return $localesCode;
    }
}
