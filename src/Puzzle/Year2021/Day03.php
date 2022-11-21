<?php

declare(strict_types=1);

namespace App\Puzzle\Year2021;

use App\Puzzle\AbstractPuzzle;

class Day03 extends AbstractPuzzle
{
    public function part1(string $input): int
    {
        $data = array_map(static fn ($e) => str_split($e), explode("\n", $input));

        $gama = $this->rateGama($data);
        $epsilon = strtr($gama, [1, 0]);

        return (int)(bindec($gama) * bindec($epsilon));
    }

    public function part2(string $input): int
    {
        $data = array_map(static fn ($e) => str_split($e), explode("\n", $input));

        $oxygen = $this->lifeRating($data);
        $co2 = $this->lifeRating($data, true);

        return (int)(bindec($oxygen) * bindec($co2));
    }

    /**
     * @param array<int, array<int, string>> $data
     */
    private function rateGama(array $data): string
    {
        $rate = array_map(null, ...$data);

        return implode('', array_map(static fn ($entry) => (array_sum($entry) >= count($entry) / 2) ? '1' : '0', $rate));
    }

    /**
     * @param array<int, array<int, string>> $data
     */
    private function lifeRating(array $data, bool $reversed = false): string
    {
        $search = 0;
        while (count($data) > 1) {
            $rate = $this->rateGama($data);

            if ($reversed) {
                $rate = strtr($rate, [1, 0]);
            }

            $rate = str_split($rate);

            $tmp = [];

            foreach ($data as $e) {
                if ($e[$search] == $rate[$search]) {
                    $tmp[] = $e;
                }
            }

            ++$search;

            $data = $tmp;
        }

        return implode('', $data[0]);
    }
}
