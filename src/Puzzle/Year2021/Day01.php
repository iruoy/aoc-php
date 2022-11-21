<?php

declare(strict_types=1);

namespace App\Puzzle\Year2021;

use App\Puzzle\AbstractPuzzle;

class Day01 extends AbstractPuzzle
{
    public function part1(string $input): int
    {
        return $this->countIncreases($input, 1);
    }

    public function part2(string $input): int
    {
        return $this->countIncreases($input, 3);
    }

    private function countIncreases(string $input, int $size): int
    {
        $increase = 0;

        $measurements = explode("\n", $input);
        $checkCount = count($measurements) - $size;

        for ($i = 0; $i < $checkCount; $i++) {
            if ($measurements[$i] < $measurements[$i + $size]) {
                $increase++;
            }
        }

        return $increase;
    }
}
