<?php

/**
 * This file is part of phplrt package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phplrt\Buffer;

use Phplrt\Contracts\Lexer\TokenInterface;

/**
 * @template-extends \SeekableIterator<positive-int|0, TokenInterface>
 */
interface BufferInterface extends \SeekableIterator
{
    /**
     * Rewind the BufferInterface to the target token element.
     *
     * @link https://php.net/manual/en/seekableiterator.seek.php
     * @see \SeekableIterator::seek()
     *
     * @param positive-int|0 $offset
     * @return void
     */
    public function seek($offset): void;

    /**
     * Return the current token.
     *
     * @link https://php.net/manual/en/iterator.current.php
     * @see \Iterator::current()
     *
     * @return TokenInterface
     */
    public function current(): TokenInterface;

    /**
     * Return the ordinal id of the current token element.
     *
     * @link https://php.net/manual/en/iterator.key.php
     * @see \Iterator::key()
     *
     * @return positive-int|0
     */
    public function key(): int;

    /**
     * Checks if current position is valid and iterator not completed.
     *
     * @link https://php.net/manual/en/iterator.valid.php
     * @see \Iterator::valid()
     *
     * @return bool
     */
    public function valid(): bool;

    /**
     * Rewind the BufferInterface to the first token element.
     *
     * @link https://php.net/manual/en/iterator.rewind.php
     * @see \Iterator::rewind()
     *
     * @return void
     */
    public function rewind(): void;

    /**
     * Move forward to next token element.
     *
     * @link https://php.net/manual/en/iterator.next.php
     * @see \Iterator::next()
     *
     * @return void
     */
    public function next(): void;
}
