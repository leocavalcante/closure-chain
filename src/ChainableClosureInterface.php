<?php declare(strict_types=1);

namespace ClosureChain;

use Closure;

/**
 * @template T
 */
interface ChainableClosureInterface
{
    /**
     * @param T $data
     * @return T
     */
    public function __invoke(mixed $data): mixed;

    public function chain(Closure $closure): self;
}
