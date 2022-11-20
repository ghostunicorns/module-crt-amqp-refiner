<?php
/*
 * Copyright © GhostUnicorns All rights reserved.
 * See LICENSE and/or COPYING.txt for license details.
 */

declare(strict_types=1);

namespace GhostUnicorns\CrtAmqpRefiner\Model;

use Magento\Framework\Api\Search\SearchResult;
use GhostUnicorns\CrtAmqpRefiner\Api\Data\RefinerSearchResultInterface;

class RefinerSearchResult extends SearchResult implements RefinerSearchResultInterface
{

}
