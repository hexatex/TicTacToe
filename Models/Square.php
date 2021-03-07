<?php

class Square
{
    /** @var Rows|int */
    protected $row;

    /** @var Columns|int */
    protected $column;

    public function __construct(int $row, int $column)
    {
        $this->row = $row;
        $this->column = $column;
    }

    /**
     * @return Rows|int
     */
    public function getRow(): int
    {
        return $this->row;
    }

    /**
     * @return Columns|int
     */
    public function getColumn(): int
    {
        return $this->column;
    }
}
