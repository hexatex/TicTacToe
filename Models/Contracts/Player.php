<?php

interface Player
{
    public function setBoard(Board $board): void;
    public function setSymbol(string $symbol): void;
    public function getNextMark(): Mark;
    public function learn(float $points): void;
}
