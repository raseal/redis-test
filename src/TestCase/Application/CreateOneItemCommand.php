<?php

declare(strict_types=1);

namespace TestCase\Application;

use Shared\Domain\Bus\Command\Command;

final class CreateOneItemCommand implements Command
{
    public function __construct(
        private string $id,
        private string $name
    ) {}

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
