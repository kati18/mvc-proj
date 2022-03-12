<?php

declare(strict_types=1);

// namespace App\Dice;

// use PHPUnit\Framework\TestCase;

namespace App\Tests\Guess;

use App\Guess\Guess;
use PHPUnit\Framework\TestCase;

/**
 * Test class for class Dice.
 */
class GuessTest extends TestCase
{
    private $guess;

    /**
     * Creates an instance/object of class Guess, no arguments.
     * Runs before every test method in the class.
     */
    protected function setUp(): void
    {
        $this->guess = new Guess();
    }

    /**
     * Tears down/clears the instance/object of class Guess after
     * each method in the class has run. The object can then be collected
     * by the garbage collector.
     */
    protected function tearDown(): void
    {
        unset($this->guess);
    }

    public function testRandom(): void
    {
        $res = $this->guess->random();
        $this->assertGreaterThan(0, $res);
        $this->assertLessThan(101, $res);
    }

    public function testTries(): void
    {
        $res = $this->guess->tries();
        $this->assertEquals(6, $res);
    }

    public function testNumber(): void
    {
        $guess = new Guess(number: 5);
        $res = $guess->number();
        $this->assertEquals(5, $res);
    }

    public function testMakeGuessHigher(): void
    {
        $guess = new Guess(number: 10);
        $res = $guess->makeGuess(19);
        $exp = "TOO HIGH";
        $this->assertEquals($exp, $res);
    }

    public function testMakeGuessLower(): void
    {
        $guess = new Guess(number: 19);
        $res = $guess->makeGuess(10);
        $exp = "TOO LOW";
        $this->assertEquals($exp, $res);
    }

    public function testMakeGuessCorrect(): void
    {
        $guess = new Guess(number: 8);
        $res = $guess->makeGuess(8);
        $exp = "CORRECT";
        $this->assertEquals($exp, $res);
    }

    // public function testMakeGuessException(): void
    // {
    //     $guess = new Guess(number: 20);
    //     $res = $guess->makeGuess(110);
    //     $exp = "Sorry, your guess can only be an integer between 1 and 100.";
    //     $this->assertEquals($exp, $res);
    // }
}
