<?php

declare(strict_types=1);

namespace App\State\Infrastructure\Repository;

use App\State\Domain\Repository\StateRepositoryInterface;
use App\State\Infrastructure\Entity\State;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Uid\Uuid;

final readonly class StateRepository implements StateRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {}

    public function addState(Uuid $uuid, string $name): void
    {
        $state = new State(
            $uuid,
            $name
        );

        $this->em->persist($state);
    }
}
