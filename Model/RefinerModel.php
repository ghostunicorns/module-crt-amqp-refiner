<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpRefiner\Model;

use DateTime;
use Exception;
use Magento\Framework\Model\AbstractExtensibleModel;
use GhostUnicorns\CrtAmqpRefiner\Api\Data\RefinerInterface;

class RefinerModel extends AbstractExtensibleModel implements RefinerInterface
{
    const ID = 'refiner_id';
    const ACTIVITY_ID = 'activity_id';
    const ENTITY_IDENTIFIER = 'entity_identifier';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    const CACHE_TAG = 'crt_amqp_refiner';
    protected $_cacheTag = 'crt_amqp_refiner';
    protected $_eventPrefix = 'crt_amqp_refiner';

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return int
     */
    public function getActivityId(): int
    {
        return (int)$this->getData(self::ACTIVITY_ID);
    }

    /**
     * @param int $activityId
     * @return void
     */
    public function setActivityId(int $activityId)
    {
        $this->setData(self::ACTIVITY_ID, $activityId);
    }

    /**
     * @return string
     */
    public function getEntityIdentifier(): string
    {
        return (string)$this->getData(self::ENTITY_IDENTIFIER);
    }

    /**
     * @param $entityIdentifier
     */
    public function setEntityIdentifier($entityIdentifier)
    {
        $this->setData(self::ENTITY_IDENTIFIER, $entityIdentifier);
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return (string)$this->getData(self::STATUS);
    }

    /**
     * @param string $type
     */
    public function setStatus(string $type)
    {
        $this->setData(self::STATUS, $type);
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt(): DateTime
    {
        return new DateTime($this->getData(self::CREATED_AT));
    }

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getUpdatedAt(): DateTime
    {
        return new DateTime($this->getData(self::UPDATED_AT));
    }

    protected function _construct()
    {
        $this->_init(ResourceModel\RefinerResourceModel::class);
    }
}
