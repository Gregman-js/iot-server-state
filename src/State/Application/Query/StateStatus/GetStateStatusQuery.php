<?php

declare(strict_types=1);

namespace App\State\Application\Query\StateStatus;

final readonly class GetStateStatusQuery
{
    public function __construct(
        public string $name
    ) {}
}
