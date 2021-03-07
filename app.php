<?php

require_once __DIR__ . '/AutoLoader.php';

class App
{
    /** @var Options */
    private $options;

    /** @var int */
    private $xScore = 0;

    /** @var int */
    private $yScore = 0;

    /** @var int */
    private $drawCount = 0;

    /** @var BoardService */
    private $boardService;

    public function __construct(Options $options)
    {
        $this->options = $options;
        $this->boardService = new BoardService;
    }

    /**
     * @throws Exception
     */
    public function main()
    {
        if ($this->options->noDisplay()) {
            $this->withoutDisplay();
        } else {
            $this->withDisplay();
        }

        echo $this->newLine() . "X: {$this->xScore} Y: {$this->yScore} Draw: {$this->drawCount}" . $this->newLine(2);

        if ($this->xScore > $this->yScore) {
            echo "X Wins";
        } elseif ($this->xScore < $this->yScore) {
            echo "Y Wins";
        } else {
            echo "Its a draw!";
        }

        echo $this->newLine();
    }

    public function withDisplay(): void
    {
        for ($i = 1; $i <= $this->options->gameCount(); $i++) {
            $board = $this->playGame();

            $result = $board->isDraw() ? 'Draw' : $board->getWinningSymbol();

            echo $this->newLine() . "# Game {$i}, {$result}" . $this->newLine(2);
            echo $this->row($board, Rows::one);
            echo $this->divider();
            echo $this->row($board, Rows::two);
            echo $this->divider();
            echo $this->row($board, Rows::three);
        }
    }

    public function withoutDisplay(): void
    {
        for ($i = 1; $i <= $this->options->gameCount(); $i++) {
            $this->playGame();
        }
    }

    private function playGame(): Board
    {
        $board = $this->boardService->get();

        $symbol = Arr::randomElement([Symbols::x, Symbols::o]);
        while(!$board->isOver()) {
            $square = Arr::randomElement($board->getAvailableSquares());

            $mark = new Mark($symbol, $square);
            $board->addMark($mark);
            $symbol = $symbol === Symbols::x ? Symbols::o : Symbols::x;
        }

        if ($board->getWinningSymbol() === Symbols::x) {
            $this->xScore++;
        } elseif ($board->getWinningSymbol() === Symbols::o) {
            $this->yScore++;
        } elseif ($board->isDraw()) {
            $this->drawCount++;
        } else {
            throw new \Exception('There is a glitch in the matrix');
        }

        return $board;
    }

    private function row(Board $board, int $row): string
    {
        return " {$board->getSymbol($row, Columns::one)} | {$board->getSymbol($row, Columns::two)} | {$board->getSymbol($row, Columns::three)} " . $this->newLine();
    }

    private function divider(): string
    {
        return "-----------" . $this->newLine();
    }

    private function newLine(int $lines = 1): string
    {
        $newLines = '';

        for ($i = 1; $i <= $lines; $i++) {
            $newLines .= PHP_EOL;
        }

        return $newLines;
    }
}

$options = new Options;

if ($options->needsHelp()) {
    echo $options->getHelp();
    exit;
}

$app = new App($options);
$app->main();
