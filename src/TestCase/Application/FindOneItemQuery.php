<?php

declare(strict_types=1);

namespace TestCase\Application;

use Shared\Domain\Bus\Query\Query;

final class FindOneItemQuery implements Query
{
    public function __construct(
        private string $id
    ) {}

    public function id(): string
    {
        return $this->id;
    }
}
