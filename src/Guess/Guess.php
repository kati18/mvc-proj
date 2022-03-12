<?php

declare(strict_types=1);

namespace App\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number = null;
    private $tries = 6;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    public function __construct(int $number = -1, int $tries = 6)
    {
        $this->tries = $tries;
        if ($number === -1) {
            // $number = rand(1, 100);
            $number = $this->random();
        }
        $this->number = $number;
    }


    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return int
     */
    public function random(): int
    {
        return rand(1, 100);
    }




    /**
     * Get number of tries left.
     *
     * @return int as number of tries left.
     */
    public function tries(): int
    {
        return $this->tries;
    }



    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    public function number(): int
    {
        return $this->number;
    }


    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @param int $guess The guess made by the player
     * @return string to show the status of the guess made.
     */
    public function makeGuess(int $guess): string
    {
        $this->tries--;

        if ($guess === $this->number) {
            return $res = "CORRECT";
        } elseif ($guess > $this->number) {
            return $res = "TOO HIGH";
        } else {
            return $res = "TOO LOW";
        }
    }
}
