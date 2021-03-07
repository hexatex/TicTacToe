<?php

use MongoDB\BSON\Symbol;

class Line
{
    /** @var Mark|null */
    protected $markA;

    /** @var Mark|null */
    protected $markB;

    /** @var Mark|null */
    protected $markC;

    public function __construct(?Mark $markA, ?Mark $markB, ?Mark $markC)
    {
        $this->markA = $markA;
        $this->markB = $markB;
        $this->markC = $markC;
    }

    public function isDraw(): bool
    {
        $symbols = [
            $this->markA ? $this->markA->getSymbol() : null,
            $this->markB ? $this->markB->getSymbol() : null,
            $this->markC ? $this->markC->getSymbol() : null,
        ];

        return in_array(Symbols::x, $symbols) && in_array(Symbols::o, $symbols);
    }

    public function isWinningLine(): bool
    {
        if (empty($this->markA) || empty($this->markB) || empty($this->markC)) {
            return false;
        }

        return !$this->isDraw();
    }

    public function getMarkA(): Mark
    {
        return $this->markA;
    }
}
