<?php

declare(strict_types=1);

namespace App\Tests\Year2022;

use App\Tests\AbstractPuzzleTestCase;

class Day01Test extends AbstractPuzzleTestCase
{
    protected function setUp(): void
    {
        $this->solution = new \App\Puzzle\Year2022\Day01();
        $this->data = file_get_contents(__DIR__.'/../../public/data/2022/01/example.txt'); // @phpstan-ignore-line
    }

    public function testPart1(): void
    {
        $this->assertSame(24000, $this->solution->part1($this->data));
    }

    public function testPart2(): void
    {
        $this->assertSame(45000, $this->solution->part2($this->data));
    }
}
