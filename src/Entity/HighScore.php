<?php

namespace App\Entity;

use App\Repository\HighScoreRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HighScoreRepository::class)
 */
class HighScore
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $winner;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $histogramp;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $histogramc;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWinner(): ?string
    {
        return $this->winner;
    }

    public function setWinner(string $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHistogramP(): ?string
    {
        return $this->histogramp;
    }

    public function setHistogramP(?string $histogramp): self
    {
        $this->histogramp = $histogramp;

        return $this;
    }

    public function getHistogramC(): ?string
    {
        return $this->histogramc;
    }

    public function setHistogramC(?string $histogramc): self
    {
        $this->histogramc = $histogramc;

        return $this;
    }
}
