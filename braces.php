<?php

const SQUARE = 1;
const ROUND = 2;
const CURLY = 3;

function isBalanced(string $string): bool
{
    $stack = [];
    $length = strlen($string);
    for ($i = 0; $i < $length; $i++) {
        switch ($string[$i]) {
            case '(':
                $stack[] = ROUND;
                break;
            case ')':
                if (array_pop($stack) !== ROUND) return false;
                break;
            case '[':
                $stack[] = SQUARE;
                break;
            case ']':
                if (array_pop($stack) !== SQUARE) return false;
                break;
            case '{':
                $stack[] = CURLY;
                break;
            case '}':
                if (array_pop($stack) !== CURLY) return false;
                break;
        }
    }
    return empty($stack);
}

$positiveVariants = [
    "Hello world",
    "Hello [world]",
    "[Hello world]",
    "{([Hello] ) world}",
    "({H}(e)[{l}{l}](o) (world))"
];

$negativeVariants = [
    "[Hello world",
    "[Hello {world]",
    "Hello )world",
    "{([H]}ell)o world",
    "Hello world[",
    "Hello world]",
];

array_walk($positiveVariants, static function (string $string) {
    if (!isBalanced($string)) {
        throw new RuntimeException("string $string is not balanced.");
    }
});

array_walk($negativeVariants, static function (string $string) {
    if (isBalanced($string)) {
        throw new RuntimeException("string $string is balanced, but it shouldn't be.");
    }
});
