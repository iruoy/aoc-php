<?php

declare(strict_types=1);

namespace App\Puzzle\Year2021;

use App\Puzzle\AbstractPuzzle;

class Day02 extends AbstractPuzzle
{
    public function part1(string $input): int
    {
        $depth = $horizontal = 0;

        $moves = explode("\n", $input);
        foreach ($moves as $move) {
            [$action, $dist] = explode(' ', $move);
            $dist = (int) $dist;

            switch ($action) {
                case 'forward':
                    $horizontal += $dist;
                    break;
                case 'down':
                    $depth += $dist;
                    break;
                case 'up':
                    $depth -= $dist;
                    break;
            }
        }

        return $depth * $horizontal;
    }

    public function part2(string $input): int
    {
        $depth = $horizontal = $aim = 0;

        $moves = explode("\n", $input);
        foreach ($moves as $move) {
            [$action, $dist] = explode(' ', $move);
            $dist = (int) $dist;

            switch ($action) {
                case 'forward':
                    $horizontal += $dist;
                    $depth += $aim * $dist;
                    break;
                case 'down':
                    $aim += $dist;
                    break;
                case 'up':
                    $aim -= $dist;
                    break;
            }
        }

        return $depth * $horizontal;
    }
}
