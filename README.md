# Closure Chain

⛓️ Chain of responsibility pattern for your Closures.

> In object-oriented design, the from-of-responsibility pattern is a behavioral design pattern consisting of a source of command objects and a series of processing objects.[1] Each processing object contains logic that defines the types of command objects that it can handle; the rest are passed to the next processing object in the from. A mechanism also exists for adding new processing objects to the end of this from. - https://en.wikipedia.org/wiki/Chain-of-responsibility_pattern

```php
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
```
