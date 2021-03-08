<?php

class Round extends Model
{
    /** @var Mark[] */
    protected $currentMarks = [];

    /** @var Mark */
    protected $xMark;

    /** @var Mark */
    protected $oMark;

    /** @var Square[] */
    protected $nextSquares = [];

    /** @var RoundCollection */
    protected $nextRounds;

    public function setXMark(Mark $xMark): void
    {
        $this->xMark = $xMark;
    }

    public function setOMark(Mark $oMark): void
    {
        $this->oMark = $oMark;
    }

    public function setNextSquares(array $nextSquares): void
    {
        $this->nextSquares = $nextSquares;
    }

    /**
     * @return Square[]
     */
    public function getNextSquares(): array
    {
        return $this->nextSquares;
    }

    public function setNextRounds(RoundCollection $nextRounds)
    {
        $this->nextRounds = $nextRounds;
    }

    public function getNextRounds(): RoundCollection
    {
        return $this->nextRounds ?: new RoundCollection;
    }
}
