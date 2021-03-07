<?php

class SquareService
{
    /**
     * @return Square[]
     */
    public function index(): array
    {
        $squares = [];

        foreach ([Rows::one, Rows::two, Rows::three] as $row) {
            foreach ([Columns::one, Columns::two, Columns::three] as $column) {
                $squares[] = new Square($row, $column);
            }
        }

        return $squares;
    }
}
