<?php

declare(strict_types=1);

namespace App\Dice;

/**
 * A class that contains the class Histogram.
 * The class that generates the histograms for the game and for both You and the Computer.
*/

class Histogram
{
    /**
     * @var array $serie    Array consisting of faces of die rolls stored in sequence.
     * @var int $min        The lowest possible face in the stored sequence.
     * @var int $max        The highest possible face in the stored sequence.
     */
    private $serieComputer = [];
    private $minComputer;
    private $maxComputer;
    private $seriePlayer = [];
    private $minPlayer;
    private $maxPlayer;

    /**
    * Injects the object to be used as base for histogram data. The object (i e
    * the class from which the object is instantiated (here: class GameOneHundred))
    * implements the HistogramInterface
    * @param HistogramInterface $object The object holding the serie
    *
    * @return void
     */
    public function injectData(HistogramInterface $object)
    {
            $this->serieComputer = $object->getHistogramSerie("Computer");
            $this->minComputer = $object->getHistogramMin();
            $this->maxComputer = $object->getHistogramMax("Computer");

            $this->seriePlayer = $object->getHistogramSerie("You");
            $this->minPlayer = $object->getHistogramMin();
            $this->maxPlayer = $object->getHistogramMax("You");
    }


    /**
    * Returns a string as a textual representation of the histogram.
    *
    * @return string as a textual representation of the histogram
     */
    public function getAsTextPlayer(): string
    {
        $res = "";
        for ($i = $this->minPlayer; $i <= $this->maxPlayer; $i++) {
            if (in_array($i, $this->seriePlayer)) {
                $res = $res . "{$i}: ";
                for ($j = 0; $j < count(array_keys($this->seriePlayer, $i)); $j++) {
                    $res .= "x";
                }
                $res .= "\r\n";
            }
        }
        return $res;
    }

    /**
    * Returns a string as a textual representation of the histogram.
    *
    * @return string as a textual representation of the histogram
     */
    public function getAsTextComputer(): string
    {
        $res = "";
        for ($i = $this->minComputer; $i <= $this->maxComputer; $i++) {
            if (in_array($i, $this->serieComputer)) {
                $res = $res . "{$i}: ";
                for ($j = 0; $j < count(array_keys($this->serieComputer, $i)); $j++) {
                    $res .= "x";
                }
                $res .= "\r\n";
            }
        }
        return $res;
    }

    /**
    * Empties the arrays $serieComputer and $seriePlayer
    *
    * @return void
    */
    public function resetSeriesHistogram(): void
    {
        $this->serieComputer = [];
        $this->seriePlayer = [];
    }
}
