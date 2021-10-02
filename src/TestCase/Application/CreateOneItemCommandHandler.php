<?php

declare(strict_types=1);

namespace TestCase\Application;

use Shared\Domain\Bus\Command\CommandHandler;
use TestCase\Domain\Item;
use TestCase\Domain\ItemAlreadyExists;
use TestCase\Domain\ItemId;
use TestCase\Domain\ItemName;
use TestCase\Domain\ItemRepository;

final class CreateOneItemCommandHandler implements CommandHandler
{
    public function __construct(
        private ItemRepository $item_repository
    ) {}

    public function __invoke(CreateOneItemCommand $command): void
    {
        $item_id = new ItemId($command->id());

        if (null !== $this->item_repository->findById($item_id)) {
            throw new ItemAlreadyExists($item_id);
        }

        $item = new Item($item_id, new ItemName($command->name()));

        $this->item_repository->persist($item);
    }
}
