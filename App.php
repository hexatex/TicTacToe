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
        for ($i = 1; $i <= $this->options->gameCount(); $i++) {
            $this->playGame($i);
        }

        if ($this->xScore > $this->yScore) {
            echo "X Wins";
        } elseif ($this->xScore < $this->yScore) {
            echo "Y Wins";
        } else {
            echo "Its a draw!";
        }

        echo $this->newLine();
    }

    public function gameCount(): int
    {
        $cliCount = argv[1];
        if (is_numeric($cliCount)) {
            return (int)$cliCount;
        }

        return (int)readline('How many games would you like to play? ');
    }

    private function playGame(int $i): void
    {
        $board = $this->boardService->get();

        $symbol = Symbols::x;
        while(!$board->isOver()) {
            $squares = $board->getAvailableSquares();
            $square = $squares[array_rand($squares, 1)];

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

        $result = $board->isDraw() ? 'Draw' : $board->getWinningSymbol();

        echo $this->newLine() . "# Game {$i}, {$result}" . $this->newLine(2);
        echo $this->row($board, Rows::one);
        echo $this->divider();
        echo $this->row($board, Rows::two);
        echo $this->divider();
        echo $this->row($board, Rows::three);
        echo $this->newLine();
        echo "X: {$this->xScore} Y: {$this->yScore} Draw: {$this->drawCount}" . $this->newLine(2);
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
