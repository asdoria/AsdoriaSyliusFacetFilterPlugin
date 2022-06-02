<?php
declare(strict_types=1);

namespace Asdoria\SyliusFacetFilterPlugin\Controller;

use Asdoria\SyliusFacetFilterPlugin\Model\FacetGroupInterface;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Component\Resource\ResourceActions;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class FacetGroupController
 * @package Asdoria\SyliusFacetFilterPlugin\Controller
 *
 * @author  Philippe Vesin <pve.asdoria@gmail.com>
 */
class FacetGroupController extends ResourceController
{
    /**
     * @throws HttpException
     */
    public function updatePositionsAction(Request $request): Response
    {
        $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
        $this->isGrantedOr403($configuration, ResourceActions::UPDATE);
        $facetGroupsToUpdate = $request->get('facetGroups');

        if ($configuration->isCsrfProtectionEnabled() && !$this->isCsrfTokenValid('update-facet-group-position', $request->request->get('_csrf_token'))) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Invalid csrf token.');
        }

        if (in_array($request->getMethod(), ['POST', 'PUT', 'PATCH'], true) && null !== $facetGroupsToUpdate) {
            foreach ($facetGroupsToUpdate as $facetGroupToUpdate) {
                if (!is_numeric($facetGroupToUpdate['position'])) {
                    throw new HttpException(
                        Response::HTTP_NOT_ACCEPTABLE,
                        sprintf('The facetGroup position "%s" is invalid.', $facetGroupToUpdate['position'])
                    );
                }

                /** @var FacetGroupInterface $facetGroup */
                $facetGroup = $this->repository->findOneBy(['id' => $facetGroupToUpdate['id']]);
                $facetGroup->setPosition((int) $facetGroupToUpdate['position']);
                $this->manager->flush();
            }
        }

        return new JsonResponse();
    }
}
