<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList;

use Closure;
use Countable;
use Generator;
use IteratorAggregate;
use Traversable;

/**
 * @template T of int|string
 * @implements IteratorAggregate<T>
 */
final class SortedLinkedList implements IteratorAggregate, Countable
{
	/**
	 * @var Node<T>|null
	 */
	private ?Node $head = null;

	/**
	 * @var Closure(T, T): int
	 */
	private Closure $comparator;

	/**
	 * @param list<T>|null $values
	 */
	public function __construct(?array $values = null)
	{
		$values ??= [];

		/*
		 * @param T $first
		 * @param T $second
		 * @return int
		 */
		$this->comparator = static function (mixed $first, mixed $second): int {
			if (\is_int($first) && \is_int($second)) {
				return $first <=> $second;
			}

			if (\is_string($first) && \is_string($second)) {
				return strcmp($first, $second);
			}

			throw new \LogicException(
				sprintf(
					'Comparison between %s and %s is not defined',
					\gettype($first),
					\gettype($second),
				),
			);
		};

		foreach ($values as $value) {
			$this->add($value);
		}
	}

	/**
	 * @return LinkedListIterator<T>
	 */
	public function getIterator(): Traversable
	{
		return new LinkedListIterator($this->head);
	}

	public function count(): int
	{
		$result = 0;

		$currentNode = $this->head;

		while ($currentNode !== null) {
			++$result;
			$currentNode = $currentNode->getNext();
		}

		return $result;
	}

	/**
	 * @param T $value
	 */
	public function add(mixed $value): void
	{
		if ($this->head === null) {
			$this->head = new Node($value, null);

			return;
		}

		if (($this->comparator)($this->head->value, $value) > 0) {
			$newNode = new Node($value, $this->head);
			$this->head = $newNode;

			return;
		}

		$currentNode = $this->head;
		while ($currentNode->getNext() !== null) {
			$nextNode = $currentNode->getNext();
			if (($this->comparator)($nextNode->value, $value) > 0) {
				$newNode = new Node($value, $nextNode);
				$currentNode->setNext($newNode);

				return;
			}
			$currentNode = $nextNode;
		}

		$currentNode->setNext(new Node($value, null));
	}

	/**
	 * @return T|null
	 */
	public function getFirst(): mixed
	{
		return $this->head?->value;
	}

	/**
	 * @return Generator<T>
	 */
	public function toValues(): Generator
	{
		$currentNode = $this->head;

		while ($currentNode !== null) {
			yield $currentNode->value;
			$currentNode = $currentNode->getNext();
		}
	}
}
