<?php

declare(strict_types=1);

namespace App\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Test class for class Guess.
 */
class GuessCreateObjectTest extends TestCase
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

    /**
     * Asserts new object is instance of Guess. Use no arguments.
     */
    public function testIsInstanceOfNoArgument1(): void
    {
        $guess = new Guess();
        $this->assertInstanceOf(Guess::class, $guess);
    }

    /**
     * Asserts new object is instance of Guess. Use no arguments.
     */
    public function testIsInstanceOfNoArgument2(): void
    {
        $this->assertInstanceOf(Guess::class, $this->guess);
    }

    /**
     * Asserts new object is instance of Guess. Use no arguments.
     */
    public function testIsInstanceOfNoArgument3(): void
    {
        $guess = new Guess();
        $this->assertInstanceOf("\App\Guess\Guess", $guess);
        // $this->assertInstanceOf("\Kati18\Guess\Guess", $guess);
    }

    /**
     * Asserts new object is instance of Guess. Use no arguments.
     */
    public function testIsInstanceOfNoArgument4(): void
    {
        $this->assertInstanceOf("\App\Guess\Guess", $this->guess);
        // $this->assertInstanceOf("\Kati18\Guess\Guess", $this->guess);
    }
}
