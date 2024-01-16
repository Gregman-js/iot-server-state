<?php

declare(strict_types=1);

namespace App\State\Domain\Repository;

use Symfony\Component\Uid\Uuid;

interface StateRepositoryInterface
{
    public function addState(Uuid $uuid, string $name): void;
}
