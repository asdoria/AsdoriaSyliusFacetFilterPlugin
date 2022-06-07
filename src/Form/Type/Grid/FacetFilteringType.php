<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Grid;

use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetFilterCodeAwareInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetFilterInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Asdoria\SyliusFacetFilterPlugin\Repository\Model\FacetFilterRepositoryInterface;
use Asdoria\SyliusFacetFilterPlugin\Traits\AttributeFilterServiceRegistryTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\EntityManagerTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\FacetFilterCodeAwareTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\FormTypeRegistryTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\QueryBuilderTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\RequestStackTrait;
use Asdoria\SyliusFacetFilterPlugin\Traits\ShopperContextTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class FacetFilteringType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type\Grid
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilteringType extends AbstractType
{
    use QueryBuilderTrait;
    use ShopperContextTrait;
    use RequestStackTrait;
    use EntityManagerTrait;
    use FormTypeRegistryTrait;
    use FacetFilterCodeAwareTrait;
    use AttributeFilterServiceRegistryTrait;

    public array $options = [];

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return FacetFilterRepositoryInterface
     */
    public function getFacetFilterRepository(): FacetFilterRepositoryInterface
    {
        /** @var FacetFilterRepositoryInterface $repo */
        $repo = $this->entityManager
            ->getRepository(FacetFilterInterface::class);
        return $repo;
    }

    /**
     * @return Collection
     */
    public function getFacets(): Collection
    {
        $facetFilter = $this->getFacetFilter();
        $criteria    = Criteria::create()
            ->orderBy(["position" => Criteria::ASC]);
        return $facetFilter instanceof FacetFilterInterface ?
            $facetFilter->getFacets()->matching($criteria) : new ArrayCollection();
    }

    /**
     * @return FacetFilterInterface|null
     */
    public function getFacetFilter(): ?FacetFilterInterface
    {
        $resource = $this->getFacetFilterCodeAware();
        if(!$resource instanceof FacetFilterCodeAwareInterface) return null;

        return $this->getFacetFilterRepository()
            ->findOneByCode($resource->getFacetFilterCode());
    }

    /**
     * @param string $code
     *
     * @return FacetInterface|null
     */
    public function getFacetByCode(string $code): ?FacetInterface
    {
        $criteria = Criteria::create()
            ->where(Criteria::expr()->eq('code', $code));
        $facet    = $this->getFacets()->matching($criteria)->first();

        return $facet instanceof FacetInterface ? $facet : null;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        /** @var FacetInterface $attribute */

        foreach ($this->getFacets() as $facet) {
            $this->processGroupBuilder($facet, $builder);
            $className  = $this->getEntityManager()
                ->getClassMetadata($facet->getFacetType()->getResourceClass())->rootEntityName;
            $subscriber = $this->formTypeRegistry->get(
                $className,
                $facet->getFacetType()->getType()
            );
            if (!empty($subscriber)) {
                $this->initSubscriber($builder, $subscriber, $facet);
            }
        }
    }

    /**
     * @param FormBuilderInterface $builder
     * @param string               $subscriber
     * @param FacetInterface       $facet
     */
    public function initSubscriber(
        FormBuilderInterface $builder,
        string               $subscriber,
        FacetInterface       $facet
    )
    {
        $formSubscriber = new $subscriber(
            $facet,
            $this->getRequestStack(),
            $this->getQueryBuilder(),
            $this->getFacetFilterCodeAware(),
            $this->getShopperContext()->getLocaleCode(),
            $this->options
        );

        if (method_exists($formSubscriber, 'setFilterServiceRegistry'))
            $formSubscriber->setFilterServiceRegistry($this->getFilterServiceRegistry());

        $builder->addEventSubscriber($formSubscriber);
    }

    /**
     * @param FacetInterface       $attribute
     * @param FormBuilderInterface $builder
     */
    public function processGroupBuilder(
        FacetInterface       $attribute,
        FormBuilderInterface $builder
    ): void
    {
        $group        = $attribute->getFacetGroup();
        $groupBuilder = $this->buildFacetGroup($builder, $group);
        foreach ($group->getAncestors() as $ancestor) {
            $ancestorBuilder = $this->buildFacetGroup($builder, $ancestor);
            $ancestorBuilder->add($groupBuilder);
            $groupBuilder = $ancestorBuilder;
        }

        $builder->add($groupBuilder);
    }

    /**
     * @param FormBuilderInterface $builder
     * @param FacetGroupInterface  $group
     *
     * @return FormBuilderInterface
     */
    public function buildFacetGroup(
        FormBuilderInterface $builder,
        FacetGroupInterface  $group
    ): FormBuilderInterface
    {
        if ($builder->has($group->getCode())) {
            return $builder->get($group->getCode());
        }

        return $builder->create($group->getCode(), FormType::class, [
            'inherit_data' => true,
            'label'        => $group->getName(),
            'block_prefix' => 'asdoria_facet_filtering_form_group',
        ]);
    }

    public function getName()
    {
        return 'asdoria_facet_filtering';
    }
}
