<?php

class Scholar implements Player
{
    use IsPlayer {
        getNextMark as getRandomMark;
    }

    /** @var int */
    protected $turn = 1;

    /** @var Outcome[] */
    protected $outcomesByHash = [];

    /** @var Outcome[] */
    protected $outcomesByBoard = [];

    /** @var Outcome[] */
    protected $outcomesByPrevOutcome = [];

    /** @var Outcome */
    protected $lastOutcome;

    public function getNextMark(): Mark
    {
        $mark = $this->getRandomMark();

        if ($this->lastOutcome) {
            // Todo:
            // If ever next move has been tried for this outcomes board hash, then select weighted random, otherwise
            // try next possible untried mark for this $lastOutcome;
            // need to grab weighted random
        }

        $outcome = new Outcome($this->turn, $this->board, $mark);
        $this->outcomesByHash[$outcome->getBoardHash()][] = $outcome;
        $this->outcomesByBoard[$this->board->getCode()][] = $outcome;
        $this->outcomesByPrevOutcome[$this->lastOutcome->getCode()] = $outcome;
        $this->lastOutcome = $outcome;

        $this->turn++;
    }

    public function learn(float $points): void
    {
        foreach ($this->outcomesByBoard[$this->board->getCode()] as $outcome) {
            // increment points/weight somewhere
        }
    }

    /*
     * Private
     */
}
