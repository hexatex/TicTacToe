<?php

class Options
{
    /** @var string[] */
    protected $options = [];

    /** @var int|null */
    protected $gameCount;

    public function __construct()
    {
        $this->options = getopt('g:h', ['games:', 'help']);
    }

    public function needsHelp(): bool
    {
        return !$this->gameCount() || isset($this->options['h']) || isset($this->options['help']);
    }

    public function getHelp(): string
    {
        return "usage: php app.php [-h | --help] [-g | --games=<gameCount>]" . PHP_EOL;
    }

    public function gameCount(): ?int
    {
        if ($this->gameCount === null) {
            $this->gameCount = (int)($this->options['g'] ?? $this->options['games'] ?? null);
        }

        return $this->gameCount;
    }
}
