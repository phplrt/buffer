<?php

declare(strict_types=1);

namespace Phplrt\Buffer;

use Phplrt\Contracts\Lexer\TokenInterface;

class ExtrusiveBuffer extends LazyBuffer
{
    /**
     * @var string
     */
    private const ERROR_BUFFER_MEMORY_ALREADY_FREED =
        'Can not to seek to position %d, because memory allocated for %d elements in this area ' .
        'of the buffer has already been freed';

    /**
     * @var int<1, max>
     */
    public const BUFFER_DEFAULT_SIZE = 100;

    /**
     * @param iterable<TokenInterface> $stream
     */
    public function __construct(
        iterable $stream,
        /**
         * @var int<1, max>
         */
        private readonly int $size = self::BUFFER_DEFAULT_SIZE,
    ) {
        assert($this->size > 0, 'Buffer size must be greater than 0, but ' . $this->size . ' passed');

        parent::__construct($stream);
    }

    /**
     * @return int<1, max>
     */
    public function getBufferSize(): int
    {
        return $this->size;
    }

    public function seek(int $offset): void
    {
        if ($offset < \array_key_first($this->buffer)) {
            $message = \sprintf(self::ERROR_BUFFER_MEMORY_ALREADY_FREED, $offset, $this->size);

            throw new \OutOfBoundsException($message);
        }

        parent::seek($offset);
    }

    public function next(): void
    {
        if ($this->nextValid() && $this->getBufferCurrentSize() > $this->size) {
            unset($this->buffer[\array_key_first($this->buffer)]);
        }
    }
}
