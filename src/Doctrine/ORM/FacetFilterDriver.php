<?php

declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Doctrine\ORM;

use App\Entity\Product\Product;
use Asdoria\SyliusFacetFilterPlugin\Form\Type\Grid\FacetFilteringType;
use Asdoria\SyliusFacetFilterPlugin\Model\Aware\FacetFilterCodeAwareInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Asdoria\SyliusFacetFilterPlugin\Doctrine\ORM\DataSource;
use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Data\DriverInterface;
use Sylius\Component\Grid\Parameters;
use Sylius\Component\Grid\Provider\GridProviderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Sylius\Component\Grid\Definition\Grid;

/**
 * Class Driver
 * @package Asdoria\Bundle\BulkEditBundle\Doctrine\ORM
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetFilterDriver implements DriverInterface
{
    const _ARGUMENT_TYPE = 'argument';
    protected DriverInterface $inner;

    protected RequestStack $requestStack;

    protected GridProviderInterface $gridProvider;

    protected array $services = [];

    /**
     * @param DriverInterface       $inner
     * @param RequestStack          $requestStack
     * @param GridProviderInterface $gridProvider
     * @param array                 $services
     */
    public function __construct(
        DriverInterface       $inner,
        RequestStack          $requestStack,
        GridProviderInterface $gridProvider,
        array                 $services
    )
    {
        $this->inner        = $inner;
        $this->requestStack = $requestStack;
        $this->gridProvider = $gridProvider;
        $this->services     = $services;
    }

    /**
     * @param array      $configuration
     * @param Parameters $parameters
     *
     * @return DataSourceInterface
     * @throws \ReflectionException
     */
    public function getDataSource(array $configuration, Parameters $parameters): DataSourceInterface
    {
        $class = $configuration['class'] ?? null;
        if ($class !== Product::class) return $this->inner->getDataSource($configuration, $parameters);

        $grid = $this->requestStack->getMainRequest()->attributes->get('_sylius', [])['grid'] ?? null;

        if (empty($grid)) return $this->inner->getDataSource($configuration, $parameters);

        $gridDefinition = $this->gridProvider->get($grid);
        if (!$gridDefinition instanceof Grid || !$gridDefinition->hasFilter('facets_filters')) {
            return $this->inner->getDataSource($configuration, $parameters);
        }

        $filter   = $gridDefinition->getFilter('facets_filters');
        $name     = $filter->getOptions()['owner'] ?? null;
        $resource = $configuration['repository']['arguments'][$name] ?? null;

        if (!$resource instanceof FacetFilterCodeAwareInterface) return $this->inner->getDataSource($configuration, $parameters);

        $dataSource = $this->inner->getDataSource($configuration, $parameters);

        $reflectionProperty = new \ReflectionProperty(get_class($dataSource), 'queryBuilder');
        $reflectionProperty->setAccessible(true);
        $queryBuilder = $reflectionProperty->getValue($dataSource);

        foreach ($this->services as $service) {
            if (method_exists($service, 'setQueryBuilder')) $service->setQueryBuilder($queryBuilder);
            if (method_exists($service, 'setFacetFilterCodeAware')) $service->setFacetFilterCodeAware($resource);
            if (method_exists($service, 'setOptions')) $service->setOptions($filter->getOptions());
        }

        return $dataSource;
    }
}
