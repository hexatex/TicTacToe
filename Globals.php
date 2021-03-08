<?php

function dd(...$dump)
{
    print_r($dump);
    exit;
}

function dump(...$dump)
{
    var_dump($dump);
}
