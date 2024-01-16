<?php

declare(strict_types=1);

namespace App\State\Entrypoint\Cli;

use App\State\Domain\Repository\StateRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Uid\Factory\UuidFactory;

#[AsCommand('state:create', 'create state')]
final class CreateStateCommand extends Command
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly UuidFactory $uuidFactory,
        private readonly StateRepositoryInterface $states
    ) {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Create state in db.')
            ->addArgument('name', InputArgument::REQUIRED, 'State name')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $uuid = $this->uuidFactory->create();

        /** @var string $name */
        $name = $input->getArgument('name');

        $this->states->addState($uuid, $name);

        $this->em->flush();

        return Command::SUCCESS;
    }
}
