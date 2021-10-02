<?php

declare(strict_types=1);

namespace TestCase\Infrastructure;

use Predis\Client;
use TestCase\Domain\Item;
use TestCase\Domain\ItemId;
use TestCase\Domain\ItemName;
use TestCase\Domain\ItemRepository;

final class RedisItemRepository implements ItemRepository
{
    public function __construct(
        private Client $connection
    ) {}

    public function findById(ItemId $item_id): ?Item
    {
        $data = $this->connection->get($item_id->value());

        if (null === $data) {
            return null;
        }

        return new Item(
            $item_id,
            new ItemName($data)
        );
    }
}
