<?php

declare(strict_types=1);

namespace TestCase\Domain;

use Shared\Domain\Exception\DomainError;
use function sprintf;

final class ItemAlreadyExists extends DomainError
{
    private ItemId $item_id;

    public function __construct(ItemId $item_id)
    {
        $this->item_id = $item_id;
        parent::__construct();
    }

    public function errorCode(): string
    {
        return "item_id_already_exists";
    }

    public function errorMessage(): string
    {
        return sprintf(
            'Item %s already exists',
            $this->item_id->value()
        );
    }
}
