<?php

declare(strict_types=1);

namespace App\Command;

use App\Puzzle\AbstractPuzzle;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(name: 'app:run')]
class RunCommand extends Command
{
    protected function configure(): void
    {
        $now = new \DateTime();

        $this
            ->addOption('year', 'y', InputOption::VALUE_REQUIRED, 'Year', $now->format('Y'))
            ->addOption('day', 'd', InputOption::VALUE_REQUIRED, 'Day', $now->format('d'))
            ->addOption('test');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $year = $input->getOption('year');
        $day = sprintf('%02d', $input->getOption('day')); // @phpstan-ignore-line
        $test = $input->getOption('test');

        $classString = '\App\Puzzle\Year'.$year.'\Day'.$day;
        if (!class_exists($classString)) {
            $output->writeln('The solution for this day doesn\'t exist.');

            return Command::FAILURE;
        }

        $solution = new $classString();
        if (!$solution instanceof AbstractPuzzle) {
            $output->writeln('The solution for this day doesn\'t exist.');

            return Command::FAILURE;
        }

        $filename = __DIR__.'/../../public/data/'.$year.'/'.$day.'/'.($test ? 'example' : 'input').'.txt';
        if (!file_exists($filename)) {
            $output->writeln('The '.($test ? 'example' : 'input').' for this day doesn\'t exist.');

            return Command::FAILURE;
        }

        $data = file_get_contents($filename);
        if (!is_string($data)) {
            $output->writeln('The '.($test ? 'example' : 'input').' for this day doesn\'t exist.');

            return Command::FAILURE;
        }

        $output->writeln('Part 1: '.$solution->part1($data));
        $output->writeln('Part 2: '.$solution->part2($data));

        return Command::SUCCESS;
    }
}
