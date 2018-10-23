<?php

namespace PanzerPlanet\Language;

class Parser
{

    private $tokens;

    private $count;


    /**
     * Parser constructor.
     */
    public function __construct()
    {
        $this->tokens = [];
        $this->count = 0;
    }

    /**
     * @param $tokens
     * @return array
     */
    public function parse(array $tokens)
    {
        $this->tokens = $tokens;
        return $this->parseExpr();
    }

    private function parseExpr()
    {
        if ($this->isNumber($this->peek())) {
            return $this->parseNum();
        }
        return $this->parseOp();
    }

    /**
     * @param string $token
     * @return bool
     */
    private function isNumber(string $token): bool
    {
        return (bool)\preg_match('/\d/', $token);
    }

    /**
     * @return bool|mixed
     */
    private function peek()
    {
        if (isset($this->tokens[$this->count]))
            return $this->tokens[$this->count];
        return null;
    }

    /**
     * @return int
     */
    private function consume()
    {
        return $this->tokens[$this->count++];
    }

    /**
     * @return array
     */
    private function parseNum(): array
    {
        return ['val' => (int)$this->consume(), 'type' => Symbol::INTEGER];
    }

    /**
     * @return array
     */
    private function parseOp(): array
    {
        $node = ['val' => $this->consume(), 'type' => Symbol::OPERATOR, 'expr' => []];
        while ($this->peek())
            array_push($node['expr'], $this->parseExpr());
        return $node;
    }
}