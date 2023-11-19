<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList;

/**
 * @template T
 */
final class Node
{
	/**
	 * @param T $value
	 * @param Node<T>|null $next
	 */
	public function __construct(
		public readonly mixed $value,
		private ?self $next = null,
	) {
	}

	/**
	 * @param Node<T>|null $next
	 */
	public function setNext(?self $next): void
	{
		$this->next = $next;
	}

	/**
	 * @return Node<T>|null
	 */
	public function getNext(): ?self
	{
		return $this->next;
	}
}
