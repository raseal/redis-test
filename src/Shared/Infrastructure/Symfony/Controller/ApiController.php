<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Symfony\Controller;

use Shared\Domain\Bus\Command\CommandBus;
use Shared\Domain\Bus\Query\QueryBus;
use Symfony\Component\Serializer\SerializerInterface;
use function Lambdish\Phunctional\each;

abstract class ApiController extends Controller
{
    public function __construct(
        protected QueryBus $queryBus,
        protected CommandBus $commandBus,
        protected SerializerInterface $serializer,
        ApiExceptionsHttpStatusCodeMapping $exceptionHandler
    ) {
        parent::__construct($this->queryBus, $this->commandBus, $this->serializer);
        each(
            fn(int $httpCode, string $exceptionClass) => $exceptionHandler->register($exceptionClass, $httpCode),
            $this->exceptions()
        );
    }

    abstract protected function exceptions(): array;
}
