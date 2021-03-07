<?php

class Mark
{
    /** @var Symbols|string */
    protected $symbol;

    /** @var Square|null */
    protected $square;

    /**
     * @param Symbols|string $symbol
     * @param Square $square
     */
    public function __construct(string $symbol, Square $square)
    {
        parent::__construct();

        $this->symbol = $symbol;
        $this->square = $square;
    }

    /**
     * @return Symbols|string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getSquare(): Square
    {
        return $this->square;
    }
}
