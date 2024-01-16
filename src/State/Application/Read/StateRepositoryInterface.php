<?php

declare(strict_types=1);

namespace App\State\Application\Read;

use App\State\Application\View\StateStatus;

interface StateRepositoryInterface
{
    public function getStateStatusByName(string $name): StateStatus;
}
