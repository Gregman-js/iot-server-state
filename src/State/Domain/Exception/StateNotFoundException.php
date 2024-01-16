<?php

declare(strict_types=1);

namespace App\State\Domain\Exception;

final class StateNotFoundException extends \DomainException
{
    public static function create(string $name): self
    {
        return new self(sprintf('State with name %s not found', $name));
    }
}
