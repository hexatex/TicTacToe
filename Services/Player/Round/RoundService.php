<?php

class RoundService
{
    private $test = 1;

    public function getRounds(Board $board): RoundCollection
    {
        $availableSquares = $board->getAvailableSquares();

        $roundCollection = $this->getNextRounds($availableSquares);
        $this->test++;
        /** @var Round $round */
        foreach ($roundCollection as $round) {
            $this->test($round);
            exit;
        }

        // dd($roundCollection);
        // /** @var Round $round */
        // foreach ($roundCollection as $round) {
        //     foreach ($round->getNextRounds() as $round) {
        //         dd('asdf');
        //     }
        // }

        return $roundCollection;
    }

    /*
     * Private
     */

    public function test(Round $round)
    {
        $nextRounds = $this->getNextRounds($round->getNextSquares());
        $round->setNextRounds($nextRounds);

        if ($nextRounds->isEmpty()) {
            return;
        }

        foreach ($nextRounds as $nextRound) {
            $this->test($nextRound);
        }
    }

    /**
     * @param Square[] $availableSquares
     * @return RoundCollection
     */
    private function getNextRounds(array $availableSquares): RoundCollection
    {
        $roundCollection = new RoundCollection;
        foreach ($availableSquares as $xCode => $xSquare) {
            $oSquares = Arr::withoutKey($availableSquares, $xCode);
            if (empty($oSquares)) {
                return $roundCollection;
            }

            foreach ($oSquares as $oCode => $oSquare) {

                $nextSquares = Arr::withoutKey($oSquares, $oCode);
echo $this->test;
                $round = new Round;
                $round->setXMark(new Mark(Symbols::x, $xSquare));
                $round->setOMark(new Mark(Symbols::o, $oSquare));
                $round->setNextSquares($nextSquares);
                $roundCollection[] = $round;
            }
        }

        return $roundCollection;
    }
}
