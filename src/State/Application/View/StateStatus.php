<?php

declare(strict_types=1);

namespace App\State\Application\View;

final readonly class StateStatus
{
    public function __construct(
        public bool $status
    ) {}
}
