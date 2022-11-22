<?php

declare(strict_types=1);

namespace App\Tests\Year2021;

use App\Tests\AbstractPuzzleTestCase;

class Day04Test extends AbstractPuzzleTestCase
{
    protected function setUp(): void
    {
        $this->solution = new \App\Puzzle\Year2021\Day04();
        $this->data = file_get_contents(__DIR__.'/../../public/data/2021/04/example.txt'); // @phpstan-ignore-line
    }

    public function testPart1(): void
    {
        $this->assertSame(4512, $this->solution->part1($this->data));
    }

    public function testPart2(): void
    {
        $this->assertSame(1924, $this->solution->part2($this->data));
    }
}
