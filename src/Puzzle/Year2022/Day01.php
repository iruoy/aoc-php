<?php

declare(strict_types=1);

namespace App\Puzzle\Year2022;

use App\Puzzle\AbstractPuzzle;

class Day01 extends AbstractPuzzle
{
    public function part1(string $input): int
    {
        $total_calories = $this->getTotalCalories($input);

        return $total_calories[0];
    }

    public function part2(string $input): int
    {
        $total_calories = $this->getTotalCalories($input);

        return $total_calories[0] + $total_calories[1] + $total_calories[2];
    }

    /**
     * @return array<array-key, int>
     */
    private function getTotalCalories(string $input): array
    {
        $total_calories = [];

        foreach (explode("\n\n", $input) as $elf) {
            $calories = 0;

            foreach (explode("\n", $elf) as $item) {
                $calories += (int) $item;
            }

            $total_calories[] = $calories;
        }

        rsort($total_calories);

        return $total_calories;
    }
}
