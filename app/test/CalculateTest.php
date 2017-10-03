<?php

namespace PHPCIDemo;

use PHPCIDemo\Calculate;
use PHPUnit\Framework\TestCase;

/**
 * Class CalculateTest
 */
class CalculateTest extends TestCase {
    public function testTrue() {
        $this->assertEquals(true, true);
    }

    /**
     * @dataProvider multiplyProvider
     */
    public function testMultiply($x, $y, $expected) {
        $this->assertEquals(Calculate::multiply($x, $y), $expected);
    }

    public function multiplyProvider() {
        return [
            [1, 2, 2],
            [1.5, 2, 3],
            [2, 2, 4],
            [1024, 512, 524288],
            [2506, 52312, 131093872],
            [1.52, 52.574, 79.91248],
            [-1, 50, -50],
            [0, 5202, 0],
            [0.1, 7640, 764]
        ];
    }

    /**
     * @dataProvider squareProvider
     */
    public function testSquare($x, $expected) {
        $this->assertEquals(Calculate::square($x), $expected);
    }

    public function squareProvider() {
        return [
            [2, 4],
            [0, 0],
            [1, 1],
            [3, 9],
            [1425, 2030625],
            [-1, 1],
            [-10, 100],
            [0.5, 0.25]
        ];
    }

    /**
     * @dataProvider addProvider
     */
    public function testAdd($x, $y, $expected) {
        $this->assertEquals(Calculate::add($x, $y), $expected);
    }

    public function addProvider() {
        return [
            [2, 2, 4],
            [0, 1, 1],
            [1, 100, 101],
            [3, 6, 9],
            [152074, 672206, 824280],
            [-100, 1, -99],
            [-10, 0, -10],
            [0.5, 0.25, 0.75]
        ];
    }
}