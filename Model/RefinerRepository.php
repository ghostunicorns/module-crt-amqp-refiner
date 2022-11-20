<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpRefiner\Model;

use Exception;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;
use GhostUnicorns\CrtAmqpRefiner\Api\Data\RefinerInterface;
use GhostUnicorns\CrtAmqpRefiner\Api\Data\RefinerSearchResultInterface;
use GhostUnicorns\CrtAmqpRefiner\Api\Data\RefinerSearchResultInterfaceFactory;
use GhostUnicorns\CrtAmqpRefiner\Api\RefinerRepositoryInterface;
use GhostUnicorns\CrtAmqpRefiner\Model\RefinerModelFactory as RefinerFactory;
use GhostUnicorns\CrtAmqpRefiner\Model\ResourceModel\Entity\RefinerCollectionFactory;
use GhostUnicorns\CrtAmqpRefiner\Model\ResourceModel\RefinerResourceModel;

class RefinerRepository implements RefinerRepositoryInterface
{
    /**
     * @var RefinerFactory
     */
    private $refinerFactory;

    /**
     * @var RefinerCollectionFactory
     */
    private $collectionFactory;

    /**
     * @var RefinerResourceModel
     */
    private $refinerResourceModel;

    /**
     * @param RefinerModelFactory $refinerFactory
     * @param RefinerCollectionFactory $collectionFactory
     * @param RefinerSearchResultInterfaceFactory $refinerSearchResultInterfaceFactory
     * @param RefinerResourceModel $refinerResourceModel
     */
    public function __construct(
        RefinerFactory $refinerFactory,
        RefinerCollectionFactory $collectionFactory,
        RefinerSearchResultInterfaceFactory $refinerSearchResultInterfaceFactory,
        RefinerResourceModel $refinerResourceModel
    ) {
        $this->refinerFactory = $refinerFactory;
        $this->collectionFactory = $collectionFactory;
        $this->refinerResourceModel = $refinerResourceModel;
    }

    /**
     * @param int $id
     * @return RefinerInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): RefinerInterface
    {
        $refiner = $this->refinerFactory->create();
        $this->refinerResourceModel->load($refiner, $id);
        if (!$refiner->getId()) {
            throw new NoSuchEntityException(__('Unable to find CrtAmqpRefiner with ID "%1"', $id));
        }
        return $refiner;
    }

    /**
     * @param RefinerInterface $refiner
     * @throws Exception
     */
    public function delete(RefinerInterface $refiner)
    {
        $this->refinerResourceModel->delete($refiner);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return RefinerSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): RefinerSearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->addFiltersToCollection($searchCriteria, $collection);
        $this->addSortOrdersToCollection($searchCriteria, $collection);
        $this->addPagingToCollection($searchCriteria, $collection);

        $collection->load();

        return $this->buildSearchResult($searchCriteria, $collection);
    }

    /**
     * @param int $activityId
     * @param string $entityIdentifier
     * @param string $status
     * @throws AlreadyExistsException
     */
    public function createOrUpdate(int $activityId, string $entityIdentifier, string $status)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(RefinerModel::ACTIVITY_ID, ['eq' => $activityId]);
        $collection->addFieldToFilter(RefinerModel::ENTITY_IDENTIFIER, ['eq' => $entityIdentifier]);

        /** @var RefinerModel $refiner */
        if ($collection->count()) {
            $refiner = $collection->getFirstItem();
        } else {
            $refiner = $this->refinerFactory->create();
            $refiner->setActivityId($activityId);
            $refiner->setEntityIdentifier($entityIdentifier);
        }

        $refiner->setStatus($status);

        $this->save($refiner);
    }

    /**
     * @param RefinerInterface $refiner
     * @return RefinerInterface
     * @throws AlreadyExistsException
     */
    public function save(RefinerInterface $refiner)
    {
        $this->refinerResourceModel->save($refiner);
        return $refiner;
    }

    /**
     * @param int $activityId
     * @param string $entityIdentifier
     * @param string $status
     * @throws AlreadyExistsException
     * @throws NoSuchEntityException
     */
    public function update(int $activityId, string $entityIdentifier, string $status)
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(RefinerModel::ACTIVITY_ID, ['eq' => $activityId]);
        $collection->addFieldToFilter(RefinerModel::ENTITY_IDENTIFIER, ['eq' => $entityIdentifier]);

        if (!$collection->count()) {
            throw new NoSuchEntityException(__(
                'Non existing refiner ~ activityId:%1 ~ entityIdentifier:%2',
                $activityId,
                $entityIdentifier
            ));
        }

        /** @var RefinerInterface $refiner */
        $refiner = $collection->getFirstItem();
        $refiner->setStatus($status);

        $this->save($refiner);
    }

    /**
     * @param int $activityId
     * @return RefinerInterface[]
     */
    public function getAllByActivityId(int $activityId): array
    {
        $collection = $this->collectionFactory->create();
        $collection->addFieldToFilter(RefinerModel::ACTIVITY_ID, ['eq' => $activityId]);

        /** @var RefinerInterface[] $refiners */
        $refiners = $collection->getItems();

        return $refiners;
    }
}
