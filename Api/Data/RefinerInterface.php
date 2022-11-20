<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpRefiner\Api\Data;

use DateTime;
use Exception;
use Magento\Framework\Api\ExtensibleDataInterface;

interface RefinerInterface extends ExtensibleDataInterface
{
    /**
     * @return int
     */
    public function getActivityId(): int;

    /**
     * @param int $activityId
     * @return void
     */
    public function setActivityId(int $activityId);

    /**
     * @return string
     */
    public function getEntityIdentifier(): string;

    /**
     * @param string $entityIdentifier
     * @return void
     */
    public function setEntityIdentifier(string $entityIdentifier);

    /**
     * @return string
     */
    public function getStatus(): string;

    /**
     * @param string $type
     * @return void
     */
    public function setStatus(string $type);

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getCreatedAt(): DateTime;

    /**
     * @return DateTime
     * @throws Exception
     */
    public function getUpdatedAt(): DateTime;
}
