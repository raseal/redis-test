<?php

declare(strict_types=1);

namespace TestCase\Domain;

final class Item
{
    public function __construct(
        private ItemId $id,
        private ItemName $name
    ) {}

    public function id(): ItemId
    {
        return $this->id;
    }

    public function name(): ItemName
    {
        return $this->name;
    }
}
