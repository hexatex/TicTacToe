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

    static public function randomOrder(array $array)
    {
        $sortable = [];
        foreach ($array as $key => $element) {
            $sortable[random_int(0, count($array) * 999)] = [$key => $element];
        }

        ksort($sortable);

        return array_merge(...$sortable);
    }
}
