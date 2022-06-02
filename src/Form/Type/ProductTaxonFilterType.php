<?php

declare(strict_types=1);


namespace Asdoria\SyliusFacetFilterPlugin\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductTaxonFilterType
 * @package Asdoria\SyliusFacetFilterPlugin\Form\Type
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class ProductTaxonFilterType extends AbstractType
{
    use ContainerAwareTrait;
    /** @var ExpressionLanguage */
    private ExpressionLanguage $expression;
    /** @var RequestStack  */
    protected RequestStack $requestStack;

    /**
     * @param ExpressionLanguage $expression
     * @param RequestStack       $requestStack
     */
    public function __construct(ExpressionLanguage $expression, RequestStack $requestStack) {
        $this->expression = $expression;
        $this->requestStack = $requestStack;
    }

    /**
     * @return string|null
     */
    public function getParent()
    {
        return EntityType::class;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults([
                'label'         => false,
                'placeholder'   => 'asdoria.ui.placeholder_product_taxon',
                'parentCode'    => null,
                'class'         => null,
                'query_builder' => function (Options $options, $configs) {
                    $groupBy = $options['group_by'] ?? null;
                    return $groupBy == 'parent' ? $this->groupByParent($options) : $this->byParent($options);
                },
                'required'      => false
            ]);
    }


    /**
     * @param $options
     *
     * @return \Closure
     */
    public function byParent($options): \Closure
    {
        return function (EntityRepository $er) use ($options) {
            $parentCode = $options['parentCode'];
            if (0 === strpos($parentCode, 'expr:')) {
                $parentCode = $this->parseOptionExpression(substr($options['parentCode'], 5));
            }
            $qb      = $er->createQueryBuilder('t')
                ->leftJoin('t.parent', 'parent')
                ->where('parent.code = :parentCode')
                ->setParameter('parentCode', $parentCode ?? null)
                ->addOrderBy('t.position');

            return $qb;
        };
    }

    /**
     * @param $options
     *
     * @return \Closure
     */
    public function groupByParent($options): \Closure
    {
        return function (EntityRepository $er) use ($options) {
            $parentCode = $options['parentCode'];
            if (0 === strpos($parentCode, 'expr:')) {
                $parentCode = $this->parseOptionExpression(substr($options['parentCode'], 5));
            }

            $subQuery   = $er->createQueryBuilder('taxon')
                ->leftJoin('taxon.parent', 'parent')
                ->where("parent.code = :parentCode");

            $query = $er->createQueryBuilder('t');
            $qb    = $query
                ->where($query->expr()->in('t.parent', $subQuery->getDQL()))
                ->setParameter('parentCode', $parentCode ?? null)
                ->orderBy('t.position');

            return $qb;
        };
    }

    /**
     * @return mixed
     */
    private function parseOptionExpression(string $expression)
    {
        $request = $this->requestStack->getCurrentRequest();
        $expression = (string) preg_replace_callback(
            '/\$(\w+)/',
            /**
             * @return mixed
             */
            function (array $matches) use ($request) {
                $variable = $request->get($matches[1]);

                return is_string($variable) ? sprintf('"%s"', addslashes($variable)) : $variable;
            },
            $expression
        );

        return $this->expression->evaluate($expression, ['container' => $this->container]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'asdoria_product_taxon';
    }
}
