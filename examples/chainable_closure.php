<?php declare(strict_types=1);

use ClosureChain\ChainableClosure;

require_once __DIR__ . '/../vendor/autoload.php';

$nl = static fn (string $str): string => $str . PHP_EOL;

$from = ChainableClosure::from(static fn (string $a): string => $a . 'b')
    ->chain(static fn (string $ab): string => $ab . 'c')
    ->chain(static fn (string $abc): string => $abc .'d');

$fold = ChainableClosure::pipe(
    static fn (string $a): string => $a . 'b',
    static fn (string $ab): string => $ab . 'c',
    static fn (string $abc): string => $abc .'d',
);

echo $from->chain($nl)('a'); // abcd
echo $fold->chain($nl)('a'); // abcd
