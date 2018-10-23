<?php

namespace PanzerPlanet\Language;

class Lexer
{
    private $operators;

    /**
     * Lexer constructor.
     */
    public function __construct()
    {
        $this->operators = require('lang' . DIRECTORY_SEPARATOR . 'operators.php');
    }

    /**
     * @param string $string
     * @return array
     */
    public function lex(string $string)
    {
        return \array_filter(explode(' ', $string), function ($token) {
            return (bool)strlen(trim($token)) > 0;
        });

    }
}