<?php

class AutoLoader
{
    private $classes = [
        'Options' => __DIR__ . '/Options.php',

        // Abstracts
        'Enum' => __DIR__ . '/Abstracts/Enum.php',

        // Enums
        'Columns' => __DIR__ . '/Enums/Columns.php',
        'Rows' => __DIR__ . '/Enums/Rows.php',
        'Symbols' => __DIR__ . '/Enums/Symbols.php',

        // Helpers
        'Arr' => __DIR__ . '/Helpers/Arr.php',

        // Models
        'Board' => __DIR__ . '/Models/Board.php',
        'Line' => __DIR__ . '/Models/Line.php',
        'Mark' => __DIR__ . '/Models/Mark.php',
        'Square' => __DIR__ . '/Models/Square.php',

        // Services
        'BoardService' => __DIR__ . '/Services/BoardService.php',
        'SquareService' => __DIR__ . '/Services/SquareService.php',

        // Traits
        'HasCode' => __DIR__ . '/Traits/HasCode.php',
    ];

    public function __construct()
    {
        spl_autoload_register(function ($className) {
            $filePath = $this->classes[$className] ?? null;
            if ($filePath) {
                require_once $filePath;
            } else {
                throw new Exception("Failed to locate {$className} in AutoLoader.php");
            }
        });
    }
}

$autoLoader = new AutoLoader();
