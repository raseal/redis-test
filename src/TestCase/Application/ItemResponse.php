<?php

declare(strict_types=1);

namespace TestCase\Application;

use Shared\Domain\Bus\Query\QueryResponse;
use TestCase\Domain\Item;

final class ItemResponse implements QueryResponse
{
    private function __construct(
        private string $id,
        private string $name
    ) {}

    public static function fromItem(Item $item): self
    {
        return new self(
            $item->id()->value(),
            $item->name()->value()
        );
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
