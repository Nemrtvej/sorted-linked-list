<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList;

use Closure;
use Countable;
use Generator;
use IteratorAggregate;
use Traversable;

/**
 * @template T
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
	 * @param list<int>|null $values
	 * @return self<int>
	 */
	public static function int(?array $values = null): self
	{
		$comparator = static fn (int $first, int $second): int => $first <=> $second;

		/** @var SortedLinkedList<int> $result */
		$result = new self($values ?? [], $comparator);

		return $result;
	}

	/**
	 * @param list<string>|null $values
	 * @return self<string>
	 */
	public static function string(?array $values = null): self
	{
		$comparator = static fn (string $first, string $second): int => strcmp($first, $second);

		/** @var SortedLinkedList<string> $result */
		$result = new self($values ?? [], $comparator);

		return $result;
	}

	/**
	 * @param list<T> $values
	 * @param Closure(T, T): int $comparator
	 */
	private function __construct(array $values, Closure $comparator)
	{
		$this->comparator = $comparator;

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
	 * Easy shorthand for getting list of values as an array.
	 *
	 * @return list<T>
	 */
	public function toArray(): array
	{
		return iterator_to_array($this->toValues(), preserve_keys: false);
	}

	/**
	 * @param T $value
	 */
	public function removeElement(mixed $value): void
	{
		if ($this->head === null) {
			return;
		}

		$previousNode = null;
		$currentNode = $this->head;

		while ($currentNode !== null) {
			\assert($previousNode?->value === null || ($this->comparator)($previousNode->value, $value) !== 0);

			if (($this->comparator)($currentNode->value, $value) === 0) {
				if ($previousNode === null) {
					$this->head = $currentNode->getNext();
					$currentNode = $currentNode->getNext();
					continue;
				}

				$previousNode->setNext($currentNode->getNext());
				$currentNode = $currentNode->getNext();
				continue;
			}
			$previousNode = $currentNode;
			$currentNode = $currentNode->getNext();
		}
	}

	/**
	 * @param T $value
	 */
	public function contains(mixed $value): bool
	{
		foreach ($this->toValues() as $currentValue) {
			if (($this->comparator)($currentValue, $value) === 0) {
				return true;
			}
		}

		return false;
	}

	/**
	 * @return Generator<T>
	 */
	private function toValues(): Generator
	{
		$currentNode = $this->head;

		while ($currentNode !== null) {
			yield $currentNode->value;
			$currentNode = $currentNode->getNext();
		}
	}

	/**
	 * @param non-negative-int $index
	 */
	public function removeKey(int $index): void
	{
		$previousNode = null;
		$currentNode = $this->head;
		$currentIndex = 0;

		while ($currentNode !== null) {
			if ($currentIndex === $index) {
				if ($previousNode === null) {
					$this->head = $currentNode->getNext();

					return;
				}
				$previousNode->setNext($currentNode->getNext());
			}

			$previousNode = $currentNode;
			$currentNode = $currentNode->getNext();
			++$currentIndex;
		}
	}
}
