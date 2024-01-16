<?php

declare(strict_types=1);

namespace App\State\Infrastructure\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity]
#[ORM\HasLifecycleCallbacks]
class State
{
    public function __construct(
        #[ORM\Id]
        #[ORM\Column(type: UuidType::NAME)]
        public readonly Uuid $id,
        #[ORM\Column(length: 255)]
        public readonly string $name,
        #[ORM\Column]
        public bool $status = false,
        #[ORM\Column]
        public ?\DateTimeImmutable $updatedAt = new \DateTimeImmutable()
    ) {}

    #[ORM\PreUpdate]
    public function setUpdatedAt(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
