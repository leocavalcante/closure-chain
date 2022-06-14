<?php declare(strict_types=1);

namespace ClosureChain;

use Closure;

/**
 * @template T
 */
class ChainableClosure implements ChainableClosureInterface
{
    private ChainableClosureInterface $next;

    public function __construct(private Closure $closure)
    {
    }

    public static function from(Closure $closure): self
    {
        return new self($closure);
    }

    public static function pipe(...$closures): self
    {
        $initial = array_shift($closures);

        return array_reduce(
            $closures,
            static fn(self $acc, Closure $f): self => $acc->chain($f),
            self::from($initial),
        );
    }

    /**
     * @param T $data
     * @return T
     */
    public function __invoke(mixed $data): mixed
    {
        if (isset($this->next)) {
            return ($this->next)(($this->closure)($data));
        }

        return ($this->closure)($data);
    }

    public function chain(Closure $closure): ChainableClosureInterface
    {
        isset($this->next)
            ? $this->next->chain($closure)
            : $this->next = self::from($closure);

        return $this;
    }
}
