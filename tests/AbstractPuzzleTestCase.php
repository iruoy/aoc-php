<?php

declare(strict_types=1);

namespace App\Tests;

use App\Puzzle\AbstractPuzzle;
use PHPUnit\Framework\TestCase;

abstract class AbstractPuzzleTestCase extends TestCase
{
    protected AbstractPuzzle $solution;
    protected string $data;

    abstract public function testPart1(): void;
    abstract public function testPart2(): void;
}
