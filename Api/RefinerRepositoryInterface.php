<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpRefiner\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use GhostUnicorns\CrtAmqpRefiner\Api\Data\RefinerInterface;
use GhostUnicorns\CrtAmqpRefiner\Api\Data\RefinerSearchResultInterface;

interface RefinerRepositoryInterface
{
    /**
     * @param int $id
     * @return RefinerInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): RefinerInterface;

    /**
     * @param RefinerInterface $refiner
     * @return RefinerInterface
     */
    public function save(RefinerInterface $refiner);

    /**
     * @param RefinerInterface $refiner
     * @return void
     */
    public function delete(RefinerInterface $refiner);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return RefinerSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): RefinerSearchResultInterface;

    /**
     * @param int $activityId
     * @param string $entityIdentifier
     * @param string $status
     */
    public function createOrUpdate(int $activityId, string $entityIdentifier, string $status);

    /**
     * @param int $activityId
     * @param string $entityIdentifier
     * @param string $status
     * @throw NoSuchEntityException
     */
    public function update(int $activityId, string $entityIdentifier, string $status);

    /**
     * @param int $activityId
     * @return RefinerInterface[]
     */
    public function getAllByActivityId(int $activityId): array;
}
