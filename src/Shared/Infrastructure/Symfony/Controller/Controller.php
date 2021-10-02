<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Symfony\Controller;

use Shared\Domain\Bus\Command\Command;
use Shared\Domain\Bus\Command\CommandBus;
use Shared\Domain\Bus\Query\Query;
use Shared\Domain\Bus\Query\QueryBus;
use Shared\Domain\Bus\Query\QueryResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;

abstract class Controller extends AbstractController
{
    public function __construct(
        protected QueryBus $queryBus,
        protected CommandBus $commandBus,
        protected SerializerInterface $serializer
    ) {}

    protected function ask(Query $query): ?QueryResponse
    {
        return $this->queryBus->ask($query);
    }

    protected function dispatch(Command $command): void
    {
        $this->commandBus->dispatch($command);
    }

    protected function getPayload(Request $request): array
    {
        return json_decode($request->getContent(), true);
    }

    // TODO: Move this method to the ApiController
    protected function createApiResponse(mixed $data, int $status_code = Response::HTTP_OK): Response
    {
        return new Response(
            $this->serialize($data),
            $status_code,
            [
                'Content-Type' => 'application/json',
            ]
        );
    }

    // TODO: Move this method to the ApiController
    private function serialize(mixed $data): string
    {
        return $this->serializer->serialize($data, JsonEncoder::FORMAT);
    }
}
