<?php

namespace PanzerPlanet\Language;

class JavaScriptTranspiler
{
    private $operators;

    public function __construct()
    {
        $this->operators = require('lang' . DIRECTORY_SEPARATOR . 'operators.php');
    }

    /**
     * @param $ast
     * @return mixed|string
     */
    public function transpile($ast)
    {
        return $ast['type'] === Symbol::INTEGER ? $this->transpileNumber($ast) : $this->transpileOperator($ast);
    }

    /**
     * @param $ast
     * @return int
     */
    private function transpileNumber($ast): int
    {
        return $ast['val'];
    }

    /**
     * @param $ast
     * @return string
     */
    private function transpileOperator($ast)
    {
        return implode(' ' . $this->operators[$ast['val']] . ' ', array_map(function ($ast) {
            return $this->transpile($ast);
        }, $ast['expr']));
    }
}