<?php

declare(strict_types=1);

namespace App\State\Entrypoint\Http\Query;

use App\State\Application\Query\StateStatus\GetStateStatusQuery;
use App\State\Application\View\StateStatus;
use App\State\Entrypoint\Exception\StateException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/state/{name}', methods: ['GET'])]
final readonly class StateController
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}

    /**
     * @throws \Throwable
     */
    #[Route('/status')]
    public function stateStatus(string $name): Response
    {
        try {
            $envelope = $this->bus->dispatch(new GetStateStatusQuery($name));
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious() ?? $e;
        }

        $handledStamp = $envelope->last(HandledStamp::class);

        null === $handledStamp && throw new StateException('Cannot get state status');

        /** @var StateStatus $result */
        $result = $handledStamp->getResult();

        return new Response((string) (int) $result->status);
    }
}
