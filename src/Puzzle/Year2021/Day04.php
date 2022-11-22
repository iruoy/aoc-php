<?php

declare(strict_types=1);

namespace App\Puzzle\Year2021;

use App\Puzzle\AbstractPuzzle;

class Day04 extends AbstractPuzzle
{
    public function part1(string $input): int
    {
        $data = explode("\n\n", $input);
        $numbers = array_map('intval', explode(',', array_shift($data)));
        $boards = $this->getBoards($data);

        $drawn = [];
        foreach ($numbers as $number) {
            $drawn[] = $number;

            foreach ($boards as $board) {
                if ($this->checkBoard($board, $drawn)) {
                    return $this->countBoard($board, $drawn);
                }
            }
        }

        return 0;
    }

    public function part2(string $input): int
    {
        $data = explode("\n\n", $input);
        $numbers = array_map('intval', explode(',', array_shift($data)));
        $boards = $this->getBoards($data);

        $drawn = $bingos = [];
        foreach ($numbers as $number) {
            $drawn[] = $number;

            foreach (array_diff_key($boards, array_flip($bingos)) as $board_number => $board) {
                if ($this->checkBoard($board, $drawn)) {
                    $bingos[] = $board_number;
                }
            }

            if (count($boards) === count($bingos)) {
                return $this->countBoard($boards[end($bingos)], $drawn);
            }
        }

        return 0;
    }

    /**
     * @param array<int, string> $data
     *
     * @return array<int, array<int, array<int, int>>>
     */
    private function getBoards(array $data): array
    {
        $boards = [];

        foreach ($data as $board_number => $board_data) {
            $rows = explode("\n", $board_data);

            foreach ($rows as $row_number => $row_data) {
                preg_match_all('/\d+/', $row_data, $matches);

                foreach ($matches[0] as $column_number => $column_data) {
                    $boards[$board_number][$row_number][(int) $column_number] = (int) $column_data;
                }
            }
        }

        return $boards;
    }

    /**
     * @param array<int, array<int, int>> $board
     * @param array<array-key, int>       $drawn
     */
    private function checkBoard(array $board, array $drawn): bool
    {
        foreach ($board as $row) {
            if (!array_diff($row, $drawn)) {
                return true;
            }
        }

        foreach (array_map(null, ...$board) as $column) {
            if (!array_diff($column, $drawn)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array<int, array<int, int>> $board
     * @param array<array-key, int>       $drawn
     */
    private function countBoard(array $board, array $drawn): int
    {
        return array_sum(array_diff(array_merge(...$board), $drawn)) * end($drawn);
    }
}
