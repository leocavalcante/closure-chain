<?php declare(strict_types=1);

namespace ClosureChainTest;

use ClosureChain\ChainableClosure;
use PHPUnit\Framework\TestCase;

final class ChainableClosureTest extends TestCase
{
    public function testPipe(): void
    {
        $pipeline = ChainableClosure::pipe(
            static fn (string $a): string => $a . 'b',
            static fn (string $b): string => $b . 'c',
            static fn (string $c): string => $c . 'd',
        );

        self::assertSame('abcd', $pipeline('a'));
    }
}
