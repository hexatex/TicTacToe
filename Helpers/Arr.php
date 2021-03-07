<?php

class Arr
{
    static public function randomElement(array $array)
    {
        $keys = array_keys($array);

        return $array[
            $keys[
                random_int(0, count($keys) - 1)
            ]
        ];
    }
}
