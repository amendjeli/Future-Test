<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\DirectoryService;

class Parser extends Command
{
    /**
     * The name of the command (the part after "bin/demo").
     *
     * @var string
     */
    protected static $defaultName = 'parser';

    /**
     * The command description shown when running "php bin/demo list".
     *
     * @var string
     */
    protected static $defaultDescription = 'Parse any file in any directory';

    /**
     * Execute the command
     *
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return int 0 if everything went fine, or an exit code.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);

        $path = $io->ask(sprintf('Which folder to parse ?'));
        $directory = new DirectoryService($path);
        $directory->getDirContents($directory->dir);
        // if ($path === $result) {
        //     $io->success('Folder parser');
        // } else {
        //     $io->error(sprintf('There was an error'));
        // }

        return Command::SUCCESS;
    }
}