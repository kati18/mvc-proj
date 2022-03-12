<?php

namespace App\Dice;

/**
 * A interface for classes generating histogram reports
 */

interface HistogramInterface
{
    /**
    * Gets the array/serie consisting of faces of die rolls stored in sequence
    *
    * @param string $player
    * @return array consisting of faces of die rolls stored in sequence
    */
    public function getHistogramSerie(string $player);

    /**
    * Gets the lowest possible face in the stored sequence i e the lowest
    * value for the histogram
    *
    * @return int as the lowest possible face in the stored in sequence
    */
    // public function getHistogramMin(string $player);
    public function getHistogramMin();

    /**
    * Gets the highest possible face in the stored sequence i e the highest
    * value for the histogram
    *
    * @param string $player
    * @return int as the highest possible face in the stored in sequence
    */
    public function getHistogramMax(string $player);
}
