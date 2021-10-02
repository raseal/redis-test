<?php

declare(strict_types=1);

namespace TestCase\Domain;

interface ItemRepository
{
    public function findById(ItemId $item_id): ?Item;

    public function persist(Item $item): void;
}
