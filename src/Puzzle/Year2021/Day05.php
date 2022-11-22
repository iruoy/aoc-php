<?php

declare(strict_types=1);

namespace App\Puzzle\Year2021;

use App\Puzzle\AbstractPuzzle;

class Day05 extends AbstractPuzzle
{
    public function part1(string $input): int
    {
        $lines = $this->getLines($input);

        $grid = $this->createGrid($lines);
        $grid = $this->fillGrid($grid, $lines, false);

//        echo PHP_EOL.PHP_EOL;
//        foreach ($grid as $row) {
//            foreach ($row as $column) {
//                if (0 === $column) {
//                    echo '.';
//                } else {
//                    echo $column;
//                }
//            }
//            echo PHP_EOL;
//        }
//        exit;

        return $this->countOverlaps($grid);
    }

    public function part2(string $input): int
    {
        $lines = $this->getLines($input);

        $grid = $this->createGrid($lines);
        $grid = $this->fillGrid($grid, $lines, true);

        return $this->countOverlaps($grid);
    }

    /**
     * @return array<array-key, array<string, int>>
     */
    private function getLines(string $input): array
    {
        preg_match_all('/(?<x1>\d+),(?<y1>\d+) -> (?<x2>\d+),(?<y2>\d+)/', $input, $matches, PREG_SET_ORDER);

        $lines = [];

        foreach ($matches as $match) {
            $lines[] = array_map('intval', array_filter($match, 'is_string', ARRAY_FILTER_USE_KEY));
        }

        return $lines;
    }

    /**
     * @param array<array-key, array<string, int>> $lines
     *
     * @return array<array-key, array<array-key, int>>
     */
    private function createGrid(array $lines): array
    {
        $max_x = max([max(array_column($lines, 'x1')), max(array_column($lines, 'x2'))]);
        $max_y = max([max(array_column($lines, 'y1')), max(array_column($lines, 'y2'))]);

        $grid = [];

        for ($y = 0; $y <= $max_y; ++$y) {
            for ($x = 0; $x <= $max_x; ++$x) {
                $grid[$y][$x] = 0;
            }
        }

        return $grid;
    }

    /**
     * @param array<array-key, array<array-key, int>> $grid
     * @param array<array-key, array<string, int>>    $lines
     *
     * @return array<array-key, array<array-key, int>>
     */
    private function fillGrid(array $grid, array $lines, bool $diagonals): array
    {
        foreach ($lines as $line) {
            ['x1' => $x1, 'y1' => $y1, 'x2' => $x2, 'y2' => $y2] = $line;

            $x_dir = $x2 <=> $x1;
            $y_dir = $y2 <=> $y1;

            for ($x = $x1, $y = $y1; !($x === $x2 + $x_dir && $y === $y2 + $y_dir); $x += $x_dir, $y += $y_dir) {
                if ($diagonals || ($x1 === $x2 || $y1 === $y2)) {
                    ++$grid[$y][$x];
                }
            }
        }

        return $grid;
    }

    /**
     * @param array<array-key, array<array-key, int>> $grid
     */
    private function countOverlaps(array $grid): int
    {
        $overlaps = 0;

        $values_count = array_count_values(array_merge(...$grid));

        foreach ($values_count as $value => $count) {
            if ($value > 1) {
                $overlaps += $count;
            }
        }

        return $overlaps;
    }
}
