<?php

namespace App\Dice;

/**
 * A trait used for implementing the HistogramInterface.
 */
trait HistogramTrait
{
    /**
     * @var array $seriePlayer  The player Player´s facevalues of all rolled dices stored in sequence.
     * @var array $serieComputer  The player Computer facevalues of all rolled dices stored in sequence.
     */
    // private $seriePlayer = [];
    // private $serieComputer = [];
    private $seriePlayer;
    private $serieComputer;

    // /**
    //  * Passes validation and works in application.
    //  * Get the serie.
    //  *
    //  * @param string $player
    //  * @return array|null as the serie else null.
    //  */
    // public function getHistogramSerie(string $player): ?array
    // {
    //     if ($player === "Computer") {
    //         return $this->serieComputer;
    //     } elseif ($player === "You") {
    //         return $this->seriePlayer;
    //     }
    //     return null;
    // }

    /**
     * Passes validation and works in application.
     * Get the serie.
     *
     * @param string $player
     * @return array as the serie.
     */
    public function getHistogramSerie(string $player): array
    {
        if ($player === "Computer") {
            return $this->serieComputer;
        } else {
            return $this->seriePlayer;
        }
    }


    /**
     * Get min value for the histogram.
     *
     * @return int as the min value.
     */
    public function getHistogramMin(): int
    {
        return 1;
    }


    // /**
    //  * Passes validation and works in application.
    //  * Get max value for the histogram.
    //  *
    //  * @param string $player
    //  * @return int as the max value else null.
    //  */
    // public function getHistogramMax(string $player): ?int
    // {
    //     if ($player === "Computer") {
    //         return max($this->serieComputer);
    //     } elseif ($player === "You") {
    //         return max($this->seriePlayer);
    //     }
    //     return null;
    // }

    /**
     * Passes validation and works in application.
     * Get max value for the histogram.
     *
     * @param string $player
     * @return int as the max value.
     */
    public function getHistogramMax(string $player): int
    {
        if ($player === "Computer") {
            return max($this->serieComputer);
        } else {
            return max($this->seriePlayer);
        }
    }
}
