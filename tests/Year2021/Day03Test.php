<?php

declare(strict_types=1);

namespace App\Tests\Year2021;

use App\Tests\AbstractPuzzleTestCase;

class Day03Test extends AbstractPuzzleTestCase
{
    protected function setUp(): void
    {
        $this->solution = new \App\Puzzle\Year2021\Day03();
        $this->data = file_get_contents(__DIR__ . '/../../public/data/2021/03/example.txt'); // @phpstan-ignore-line
    }

    public function testPart1(): void
    {
        $this->assertSame(198, $this->solution->part1($this->data));
    }

    public function testPart2(): void
    {
        $this->assertSame(230, $this->solution->part2($this->data));
    }
}
