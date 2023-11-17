<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList;

use Iterator;

/**
 * @template T
 * @implements Iterator<int, T>
 */
final class LinkedListIterator implements Iterator
{
	/**
	 * @var Node<T>|null
	 */
	private ?Node $current;

	/**
	 * @var Node<T>|null
	 */
	private ?Node $head;

	private int $currentKey;

	/**
	 * @param Node<T>|null $head
	 */
	public function __construct(Node|null $head)
	{
		$this->currentKey = 0;
		$this->current = $head;
		$this->head = $head;
	}

	/**
	 * @return T|null
	 */
	public function current(): mixed
	{
		return $this->current?->value;
	}

	public function next(): void
	{
		if ($this->current === null) {
			return;
		}

		$this->current = $this->current->getNext();
		++$this->currentKey;
	}

	public function key(): ?int
	{
		if ($this->head === null) {
			return null;
		}

		return $this->currentKey;
	}

	public function valid(): bool
	{
		return $this->current !== null;
	}

	public function rewind(): void
	{
		$this->current = $this->head;
		$this->currentKey = 0;
	}
}
