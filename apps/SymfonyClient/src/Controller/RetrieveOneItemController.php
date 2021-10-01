<?php

declare(strict_types=1);

namespace SymfonyClient\Controller;

use Shared\Domain\Exception\InvalidUuid;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Response;
use TestCase\Application\FindOneItemQuery;
use TestCase\Domain\ItemDoesNotExist;

final class RetrieveOneItemController extends ApiController
{
    public function __invoke(string $id): Response
    {
        $query = new FindOneItemQuery($id);
        $response = $this->ask($query);

        return $this->createApiResponse($response);
    }

    protected function exceptions(): array
    {
        return [
            InvalidUuid::class => Response::HTTP_BAD_REQUEST,
            ItemDoesNotExist::class => Response::HTTP_NOT_FOUND,
        ];
    }
}
