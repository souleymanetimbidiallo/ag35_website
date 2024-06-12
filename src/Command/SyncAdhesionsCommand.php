<?php

namespace App\Command;

use App\Service\HelloAssoService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SyncAdhesionsCommand extends Command
{
    protected static $defaultName = 'app:sync-adhesions';
    private $helloAssoService;

    public function __construct(HelloAssoService $helloAssoService)
    {
        parent::__construct();
        $this->helloAssoService = $helloAssoService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Synchronizes adhesions from HelloAsso to the local database');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $this->helloAssoService->syncAdhesions();

        $io->success('Adhesions have been synchronized.');

        return Command::SUCCESS;
    }
}
