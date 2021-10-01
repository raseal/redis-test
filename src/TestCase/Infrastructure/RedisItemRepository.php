<?php

declare(strict_types=1);

namespace TestCase\Infrastructure;

use TestCase\Domain\Item;
use TestCase\Domain\ItemId;
use TestCase\Domain\ItemName;
use TestCase\Domain\ItemRepository;

final class RedisItemRepository implements ItemRepository
{
    public function findById(ItemId $item_id): ?Item
    {
        // TODO: Implement findById() method.
        return null;
    }
}
