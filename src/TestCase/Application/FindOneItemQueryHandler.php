<?php

declare(strict_types=1);

namespace TestCase\Application;

use Shared\Domain\Bus\Query\QueryHandler;
use TestCase\Domain\ItemDoesNotExist;
use TestCase\Domain\ItemId;
use TestCase\Domain\ItemRepository;

final class FindOneItemQueryHandler implements QueryHandler
{
    public function __construct(
        private ItemRepository $item_repository
    ) {}

    public function __invoke(FindOneItemQuery $query)
    {
        $item_id = new ItemId($query->id());
        $item = $this->item_repository->findById($item_id);

        if (null === $item) {
            throw new ItemDoesNotExist($item_id);
        }

        return ItemResponse::fromItem($item);
    }
}
