<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type\Subscriber;


use App\Entity\Product\ProductAttribute;
use App\Entity\Product\ProductAttributeValue;
use Asdoria\SyliusFacetFilterPlugin\Model\FacetTypeProductAttributeInterface;
use Sylius\Component\Attribute\Model\AttributeValueInterface;
use Sylius\Component\Resource\Model\ResourceInterface;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;

/**
 * Class Text
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class AttributeRadioTypeFormSubscriber extends AbstractAttributeTypeFormSubscriber
{
    const _IDENTIFIER = 'attribute_radio';
    const _AVAILABLE_STORAGES = [
        AttributeValueInterface::STORAGE_JSON,
        AttributeValueInterface::STORAGE_TEXT,
        AttributeValueInterface::STORAGE_FLOAT,
        AttributeValueInterface::STORAGE_INTEGER,
    ];

    /**
     * @return string
     */
    public function getFormType(): string
    {
        return ChoiceType::class;
    }

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getOptions(FormInterface $parentForm): array
    {
        $localesCode = $this->getLocalesCode();
        return array_merge(parent::getOptions($parentForm),
            [
                'choice_loader' => new CallbackChoiceLoader(function () use ($parentForm) {
                    return $this->getChoiceValues($parentForm);
                }),
                'choice_attr'   => $this->getChoiceAttr($localesCode),
                'choice_label'  => $this->getChoiceLabel($localesCode),
                'placeholder'   => 'asdoria.ui.placeholder_'.self::_IDENTIFIER,
                'expanded'      => true,
                'attr'          => array_merge([
                    'class' => 'mySelect'
                ], $this->getDataView())
            ]);
    }

    /**
     * @param array $localesCode
     *
     * @return \Closure
     */
    public function getChoiceLabel(array $localesCode): \Closure
    {
        $facetType     = $this->getFacet()->getFacetType();
        if (!$facetType instanceof FacetTypeProductAttributeInterface) {
            throw new \InvalidArgumentException('invalid facet type');
        }

        $attribute     = $facetType->getProductAttribute();
        $storage       = $attribute->getStorageType();
        return function ($choice, $key, $value) use ($localesCode, $storage) {
            return $storage === AttributeValueInterface::STORAGE_JSON ? strval($key) : strval($value);
        };
    }

    /**
     * @param array $localesCode
     *
     * @return \Closure
     */
    public function getChoiceAttr(array $localesCode): \Closure {
        return function ($choice, $key, $value) use ($localesCode) {
            $attribute     = $this->getFacet()->getFacetType()->getResource();
            $storage       = $attribute instanceof ProductAttribute ? $attribute->getStorageType() : null;
            $configurationChoice = [];
            if ($storage === AttributeValueInterface::STORAGE_JSON) {
                $configurationChoice = $attribute->getConfiguration()['choices'][$choice];
                $configurationChoiceEntity = array_filter($configurationChoice, fn($item) => $item instanceof ResourceInterface);
                if(!empty($configurationChoiceEntity)) {
                    /** @var ResourceInterface $resource */
                    foreach ($configurationChoiceEntity as $keyResource => $resource) {
                        $configurationChoice[$keyResource] = $resource->getId();
                    }
                }
            }

            return array_diff_key($configurationChoice, $localesCode);
        };
    }

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getChoiceValues(FormInterface $parentForm): array
    {
        $attribute     = $this->getFacet()->getFacetType()->getResource();
        $storage       = $attribute instanceof ProductAttribute ? $attribute->getStorageType() : null;
        $repo          = $this->entityManager->getRepository(ProductAttributeValue::class);
        $rootAlias     = $this->getQueryBuilder()->getRootAliases()[0] ?? 'o';

        if (!in_array($storage, self::_AVAILABLE_STORAGES)) {
            return [];
        }

        $qb = $repo
            ->createQueryBuilder('pav')
            ->select('DISTINCT pav.' . $storage)
            ->innerJoin('pav.attribute', 'attribute')
            ->innerJoin('pav.subject', $rootAlias)
            ->where('attribute.id = :attribute')
            ->groupBy('pav.' . $storage)
            ->setParameter('attribute', $attribute);

        $this->getFilterServiceRegistry()->filters($this, $qb);

        $attribute->isTranslatable() ?
            $qb->andWhere('pav.localeCode = :localeCode')->setParameter(':localeCode', $this->getLocaleCode()) :
            $qb->andWhere('pav.localeCode IS NULL');

        return $this->getChoicesResult($qb, $this->getFacet(), $parentForm);
    }

    /**
     * @param FormInterface $parentForm
     *
     * @return array
     */
    protected function getGroups(FormInterface $parentForm): array {
        $groups = [];
        $this->guessGroups($parentForm, $groups);
        return array_reverse($groups);
    }

    /**
     * @param FormInterface $parentForm
     * @param array         $groups
     */
    protected function guessGroups(FormInterface $parentForm, array &$groups) {
        if($parentForm->getName() == 'criteria') return;
        $groups[] = $parentForm->getName();
        if ($parentForm->getParent() instanceof FormInterface) {
            $this->guessGroups($parentForm->getParent(), $groups);
        }
    }
}
