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
        $i = 0;
        foreach ($array as $key => $element) {
            $max = count($array) * 999;
            $sortable[(int)(random_int(0, $max) . $i++)] = [$key => $element];
        }

        ksort($sortable);

        return array_merge(...$sortable);
    }

    static public function withoutKey($array, $key)
    {
        $result = [];
        foreach ($array as $keyB => $element) {
            if ($keyB !== $key) {
                $result[$keyB] = $element;
            }
        }

        return $result;
    }
}
