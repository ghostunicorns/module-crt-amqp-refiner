<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpRefiner\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface RefinerSearchResultInterface extends SearchResultsInterface
{
    /**
     * @return RefinerInterface[]
     */
    public function getItems();

    /**
     * @param RefinerInterface[] $items
     * @return void
     */
    public function setItems(array $items);
}
