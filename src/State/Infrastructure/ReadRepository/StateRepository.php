<?php

declare(strict_types=1);

namespace App\State\Infrastructure\ReadRepository;

use App\State\Application\Read\StateRepositoryInterface;
use App\State\Application\View\StateStatus;
use App\State\Domain\Exception\StateMalformedException;
use App\State\Domain\Exception\StateNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

final readonly class StateRepository implements StateRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $em
    ) {}

    #[\Override]
    public function getStateStatusByName(string $name): StateStatus
    {
        $qb = $this->em->getConnection()->createQueryBuilder();

        $qb->select('status')
            ->from('state', 's')
            ->where('s.name = :name')
            ->setParameter('name', $name)
        ;

        $result = $qb->executeQuery()->fetchAssociative();

        false === $result && throw StateNotFoundException::create($name);

        false === \is_bool($result['status']) && throw new StateMalformedException('State status is malformed');

        return new StateStatus($result['status']);
    }
}
