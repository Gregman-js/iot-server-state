<?php

declare(strict_types=1);

namespace App\State\Application\Query\StateStatus;

use App\State\Application\Read\StateRepositoryInterface;
use App\State\Application\View\StateStatus;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class GetStateStatusHandler
{
    public function __construct(
        private StateRepositoryInterface $states
    ) {}

    public function __invoke(GetStateStatusQuery $query): StateStatus
    {
        return $this->states->getStateStatusByName($query->name);
    }
}
