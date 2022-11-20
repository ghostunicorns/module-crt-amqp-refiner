<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpRefiner\Model\ResourceModel\Entity;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use GhostUnicorns\CrtAmqpRefiner\Model\RefinerModel;
use GhostUnicorns\CrtAmqpRefiner\Model\ResourceModel\RefinerResourceModel;

class RefinerCollection extends AbstractCollection
{
    protected $_idFieldName = 'refiner_id';
    protected $_eventPrefix = 'crt_amqp_refiner_collection';
    protected $_eventObject = 'refiner_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(RefinerModel::class, RefinerResourceModel::class);
    }
}
