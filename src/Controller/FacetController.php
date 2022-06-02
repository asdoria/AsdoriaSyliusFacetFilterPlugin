<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Controller;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetInterface;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class FacetController
 * @package Asdoria\SyliusFacetFilterPlugin\Controller
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetController extends ResourceController
{
    /**
     * @throws HttpException
     */
    public function updatePositionsAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $this->isGrantedOr403($configuration, ResourceActions::UPDATE);
        $facetsToUpdate = $request->get('facets');

        if ($configuration->isCsrfProtectionEnabled() && !$this->isCsrfTokenValid('update-facet-position', $request->request->get('_csrf_token'))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && null !== $facetsToUpdate) {
            foreach ($facetsToUpdate as $facetToUpdate) {
                if (!is_numeric($facetToUpdate['position'])) {
                    throw new HttpException(
                        Response::HTTP_NOT_ACCEPTABLE,
                        sprintf('The facet position "%s" is invalid.', $facetToUpdate['position'])
                    );
                }

                /** @var FacetInterface $facet */
                $facet = $this->repository->findOneBy(['id' => $facetToUpdate['id']]);
                $facet->setPosition((int) $facetToUpdate['position']);
                $this->manager->flush();
            }
        }

        return new JsonResponse();
    }
}
