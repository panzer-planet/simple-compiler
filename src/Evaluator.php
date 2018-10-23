<?php

namespace PanzerPlanet\Language;

class Evaluator
{

    /**
     * @param array $ast
     * @return mixed
     */
    public function eval(array $ast)
    {
        if ($ast['type'] === Symbol::INTEGER) {
            return $ast['val'];
        }

        return $this->operate(
            $ast['val'],
            array_map(function ($e) { return $this->eval($e); }, $ast['expr'])
        );

    }

    /**
     * @param string $operation
     * @param array $args
     * @return mixed
     */
    private function operate(string $operation, array $args)
    {
        echo "op = " . $operation . ' ' . implode(' ', $args) . "\n";
        $initial = array_shift($args);

        switch ($operation) {
            case 'sum':
                $result = array_reduce($args, function ($carry, $item) {
                    $carry += $item;
                    return $carry;
                }, $initial);
                echo "result = $result\n";
                return $result;
            case 'sub':
                $result = array_reduce($args, function ($carry, $item) {
                    $carry -= $item;
                    return $carry;
                }, $initial);
                echo "result = $result\n";
                return $result;
            case 'mul':
                return array_reduce($args, function ($carry, $item) {
                    $carry = $carry * $item;
                    return $carry;
                }, $initial);

            case 'div':
                return array_reduce($args, function ($carry = 0, $item) {
                    $carry = $carry / $item;
                    return $carry;
                }, $initial);
            default:
                throw new \RuntimeException('Unknown operator ', print_r($operation, true));
        }
    }


}