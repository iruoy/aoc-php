<?php

declare(strict_types=1);

namespace App\Puzzle;

abstract class AbstractPuzzle
{
    abstract public function part1(string $input): int;

    abstract public function part2(string $input): int;
}
