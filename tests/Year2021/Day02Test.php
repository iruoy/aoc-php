<?php

declare(strict_types=1);

namespace App\Tests\Year2021;

use PHPUnit\Framework\TestCase;

class Day02Test extends TestCase
{
    protected function setUp(): void
    {
        $this->solution = new \App\Puzzle\Year2021\Day02();
        $this->data = file_get_contents(__DIR__ . '/../../public/data/2021/02/example.txt');
    }

    public function testPart1(): void
    {
        $this->assertSame(150, $this->solution->part1($this->data));
    }

    public function testPart2(): void
    {
        $this->assertSame(900, $this->solution->part2($this->data));
    }
}
