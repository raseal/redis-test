<?php

declare(strict_types=1);

namespace SymfonyClient\Controller;

use Shared\Domain\Exception\InvalidUuid;
use Shared\Infrastructure\Symfony\Controller\ApiController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TestCase\Application\CreateOneItemCommand;
use TestCase\Domain\ItemAlreadyExists;
use function sprintf;

final class CreateOneItemController extends ApiController
{
    public function __invoke(Request $request): Response
    {
        $params = $request->request->all();
        $id = $params['id'];
        $command = new CreateOneItemCommand($id, $params['name']);

        $this->dispatch($command);

        return $this->createApiResponse(
            sprintf('Resource %s successfully created!', $id)
        );
    }

    protected function exceptions(): array
    {
        return [
            InvalidUuid::class => Response::HTTP_BAD_REQUEST,
            ItemAlreadyExists::class => Response::HTTP_BAD_REQUEST,
        ];
    }
}
