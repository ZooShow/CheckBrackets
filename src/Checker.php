<?php

declare(strict_types=1);

namespace Checker;

use PHPUnit\Exception;
use SplStack;

class Checker
{
    private SplStack $stack;

    public function __construct()
    {
        $this->stack = new SplStack();
    }

    public function check(string $str): bool
    {
        $length = strlen($str);
        for ($i = 0; $i < $length; ++$i) {
            $symbol = $str[$i];
            switch ($symbol) {
                case '[':
                case '{':
                case '(':
                    $this->stack->push($symbol);
                    break;
                case ')':
                    if ($this->stack->isEmpty()) {
                        return false;
                    }
                    $checkSymbol = $this->stack->pop();
                    if ($checkSymbol !== '(') {
                        return false;
                    }
                    break;
                case '}':
                    if ($this->stack->isEmpty()) {
                        return false;
                    }
                    $checkSymbol = $this->stack->pop();
                    if ($checkSymbol !== '{') {
                        return false;
                    }
                    break;
                case ']':
                    if ($this->stack->isEmpty()) {
                        return false;
                    }
                    $checkSymbol = $this->stack->pop();
                    if ($checkSymbol !== '[') {
                        return false;
                    }
                    break;
            }
        }

        if (!$this->stack->isEmpty()) {
            return false;
        }

        return true;
    }
}