<?php

declare(strict_types=1);

namespace App\Tests\Year2021;

use App\Tests\AbstractPuzzleTestCase;

class Day05Test extends AbstractPuzzleTestCase
{
    protected function setUp(): void
    {
        $this->solution = new \App\Puzzle\Year2021\Day05();
        $this->data = file_get_contents(__DIR__.'/../../public/data/2021/05/example.txt'); // @phpstan-ignore-line
    }

    public function testPart1(): void
    {
        $this->assertSame(5, $this->solution->part1($this->data));
    }

    public function testPart2(): void
    {
        $this->assertSame(12, $this->solution->part2($this->data));
    }
}
