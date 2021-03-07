<?php

trait HasCode
{
    /** @var string */
    protected $code;

    public function __construct()
    {
        $this->code = uniqid();
    }

    /*
     * Public
     */
    public function getCode(): string
    {
        return $this->code;
    }
}
