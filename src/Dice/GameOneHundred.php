<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * A class that contains the class GameOneHundred.
*/


// class GameOneHundred
// {
class GameOneHundred implements HistogramInterface
{
    use HistogramTrait;

    /**
     * @var GameRound $gameRound            The object gameRound
     * @var int $totScoreComputer           The total score of the computer
     * @var int $totScorePlayer             The player´s total score
     * @var int $winScore                   The score required for winning
     * @var array $totDiceFacesPlayerGame   The total facevalues of all dices rolled by the player
     * @var array $totDiceFacesComputerGame The total facevalues of all dices rolled by the computer
     */
    private $gameRound;
    private $totScoreComputer;
    private $totScorePlayer;
    private $winScore = 100;
    private $totDiceFacesPlayerGame = [];
    private $totDiceFacesComputerGame = [];


    /**
     * Constructor for initiating an object of the class GameOneHundred.
     * Refactored for unit testing purposes.
     * @param string|null $currentPlayer, defaults to null if no argument is passed in
     * @param int $totScoreComputer, defaults to 0 if no argument is passed in
     * @param int $totScorePlayer, defaults to 0 if no argument is passed in
     * @param array $seriePlayer, defaults to an empty array if no argument is passed in
     * @param array $serieComputer, defaults to an empty array if no argument is passed in
     * @return void
     */
    public function __construct(
        ?string $currentPlayer = null,
        int $totScoreComputer = 0,
        int $totScorePlayer = 0,
        array $seriePlayer = [],
        array $serieComputer = []
    ) {
        $this->gameRound = new GameRound(currentPlayer: $currentPlayer);
        $this->totScoreComputer = $totScoreComputer;
        $this->totScorePlayer = $totScorePlayer;
        $this->seriePlayer = $seriePlayer;
        $this->serieComputer = $serieComputer;
    }

    // /**
    //  * Constructor for initiating an object of the class GameOneHundred.
    //  * Refactored for unit testing purposes.
    //  * @param string|null $currentPlayer, defaults to null if no argument is passed in
    //  * @param int $totScoreComputer, defaults to 0 if no argument is passed in
    //  * @param int $totScorePlayer, defaults to 0 if no argument is passed in
    //  * @return void
    //  */
    // public function __construct(?string $currentPlayer = null, int $totScoreComputer = 0, int $totScorePlayer = 0)
    // {
    //     $this->gameRound = new GameRound(currentPlayer: $currentPlayer);
    //     $this->totScoreComputer = $totScoreComputer;
    //     $this->totScorePlayer = $totScorePlayer;
    // }


    /**
    * Sets the initial currentPlayer after the initial roll of a single die
    *
    * @param int $playerRes
    * @param int $computerRes
    * @return void
    */
    public function setInitCurrPlayerGame(int $playerRes, int $computerRes): void
    {
        $this->gameRound->setInitCurrentPlayer($playerRes, $computerRes);
    }


    /**
     * Creates an object of the class GameRound.
     * Is invoked by the method changeCurrentPlayerGame in class GameOneHundred.
     * @param string $currentPlayer
     * @return void
     */
    // private function createNewGameRoundGame(string $currentPlayer): void
    public function createNewGameRoundGame(string $currentPlayer): void
    {
        // $this->gameRound = new GameRound($currentPlayer);
        $this->gameRound = new GameRound(currentPlayer: $currentPlayer);
    }


    /**
    * Returns the gameround object
    *
    * @return GameRound The gameRound object
    */
    public function getGameRoundGame(): GameRound
    {
        return $this->gameRound;
    }


    public function changeCurrentPlayerGame(): void
    {
        $this->gameRound->getCurrentPlayer() === "You" ?
            $this->createNewGameRoundGame("Computer") :
            $this->createNewGameRoundGame("You");
    }


    /**
     * Returns the currentPlayer
     *
     * @return string|null The current player
     */
    public function getCurrentPlayerGame(): ?string
    {
        return $this->gameRound->getCurrentPlayer();
    }


    /**
     * Rolls the dices by invoking method rollGameRound in class GameRound
     *
     * @return void
     */
    public function rollGame(): void
    {
        $this->gameRound->rollGameRound();
    }


    /**
    * Plays as the player Computer
    * 2. Refactored because of unnecessary else clause according to phpmd.
    * Passes the tests and works when playing.
    *
    * @return string
    */
    public function computerPlay(int $maxInp = 0, int $minInp = 10): string
    {
        $max = $maxInp;
        $min = $minInp;
        while ($max < $min) {
            $this->rollGame();
            $this->setTotDiceFacesGame();
            $this->gameRound->setRoundScoreGameRound();
            if ($this->gameRound->getRoundScoreGameRound() !== 0) {
                $max += $this->gameRound->getRoundScoreGameRound();
            }
            if ($this->gameRound->getRoundScoreGameRound() === 0) {
                return "The computer got no points!";
            }
        }
        return "The computer is done playing its gameround!";
    }


    /**
     * Returns the facevalues of the dices by invoking
     * getDiceFacesGameRound in class GameRound
     *
     * @return array as facevalues of dices
     */
    public function getDiceFacesGame(): array
    {
        return $this->gameRound->getDiceFacesGameRound();
    }


    /**
    * Sets the round score of a game round by invoking
    * the method setRoundScoreGameRound in class GameRound
    * @return void
    */
    public function setRoundScoreGame(): void
    {
        $this->gameRound->setRoundScoreGameRound();
    }


    /**
     * Returns the round score of a game round by invoking
     * the method getRoundScoreGameRound in class GameRound
     *
     * @return int as the round score of a game round
     */
    public function getRoundScoreGame(): int
    {
        return $this->gameRound->getRoundScoreGameRound();
    }


    /**
    * Sets the total score of the current player by adding round score to the total score
    *
    * @return void
    */
    public function setTotScoreGame(): void
    {
        $this->gameRound->getCurrentPlayer() === "You" ?
            $this->totScorePlayer += $this->getRoundScoreGame() :
            $this->totScoreComputer += $this->getRoundScoreGame();
    }


    /**
    * Returns the total score of the computer
    *
    * @return int The total score of the player Computer
    */
    public function getTotScoreComputer(): int
    {
        return $this->totScoreComputer;
    }

    /**
    * Returns the total score of the player You
    *
    * @return int The total score of the player You
    */
    public function getTotScorePlayer(): int
    {
        return $this->totScorePlayer;
    }


    /**
    * Returns a string when the total score of the player You or the player Computer
    * is equal to or more than 100 i.e. the win score and null if not.
    * @return string|null
    */
    public function gameOver(): ?string
    {
        if ($this->totScorePlayer >= $this->winScore) {
            return "You won the dice game!";
        } elseif ($this->totScoreComputer >= $this->winScore) {
            return "The computer won the dice game!";
        }
        return null;
    }

    /**
    * Saves/sets the facevalues of all rolled dices
    *
    * @return void
    */
    public function setTotDiceFacesGame(): void
    {
        if ($this->gameRound->getCurrentPlayer() === "You") {
            foreach ($this->getDiceFacesGame() as $face) {
                array_push($this->totDiceFacesPlayerGame, $face);
            }
        }
        if ($this->gameRound->getCurrentPlayer() === "Computer") {
            foreach ($this->getDiceFacesGame() as $face) {
                array_push($this->totDiceFacesComputerGame, $face);
            }
        }
    }


    /**
     * New 2021-12-26 4:07 p.m. when removing class GameOneHundredHistogram.
     * Passes validation and works in application.
     * Returns the facevalues of all rolled dices
     *
     * @param string|null $player, defaults to null if no argument is passed in
     * @return array|null as facevalues of all rolled dices
     */
    public function getTotDiceFacesGame(?string $player = null): ?array
    {
        if ($player === "You") {
            foreach ($this->totDiceFacesPlayerGame as $face) {
                array_push($this->seriePlayer, $face);
            }
            return $this->totDiceFacesPlayerGame;
        } elseif ($player === "Computer") {
            foreach ($this->totDiceFacesComputerGame as $face) {
                array_push($this->serieComputer, $face);
            }
            return $this->totDiceFacesComputerGame;
        }
        return null;
    }


    /**
    * Empties the arrays $serieComputer and $seriePlayer
    *
    * @return void
    */
    public function resetSeriesGame(): void
    {
        $this->serieComputer = [];
        $this->seriePlayer = [];
    }
}
