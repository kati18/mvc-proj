<?php

declare(strict_types=1);

// namespace App\Dice;

// use PHPUnit\Framework\TestCase;

namespace App\Tests\Dice;

use App\Dice\GameOneHundred;
use App\Dice\Histogram;
use PHPUnit\Framework\TestCase;

/**
 * Test class for class Histogram.
 */
class HistogramTest extends TestCase
{
    private $histogram;

    /**
     * Creates an instance/object of class Dice, no arguments.
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        $this->histogram = new Histogram();
    }

    /**
     * Tears down/clears the instance/object of class Histogram after
     * each method in the class has run. The object can then be collected
     * by the garbage collector.
     */
    protected function tearDown(): void
    {
        unset($this->histogram);
    }

    public function testResetSeriesHistogram(): void
    {
        $gameOneHundred = new GameOneHundred(seriePlayer: [1, 2, 3], currentPlayer: "You");
        $res = $gameOneHundred->getHistogramSerie(player: "You");
        $this->histogram->resetSeriesHistogram();
        $exp = [];
        $this->assertNotEquals($res, $exp);
    }
}
