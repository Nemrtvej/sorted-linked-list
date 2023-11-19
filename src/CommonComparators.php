<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList;

use Closure;

/**
 * Factory for commonly used comparators.
 */
final class CommonComparators
{
	/**
	 * Comparator for integers. Sorts in ascendant order.
	 *
	 * @return Closure(int, int): int
	 */
	public static function intAsc(): Closure
	{
		return static fn (int $first, int $second): int => $first <=> $second;
	}

	/**
	 * Comparator for integers. Sorts in descendant order.
	 *
	 * @return Closure(int, int): int
	 */
	public static function intDesc(): Closure
	{
		return static fn (int $first, int $second): int => $second <=> $first;
	}

	/**
	 * Comparator for strings. Sorts in ascendant order.
	 *
	 * @return Closure(string, string): int
	 */
	public static function stringAsc(): Closure
	{
		return static fn (string $first, string $second): int => strcmp($first, $second);
	}

	/**
	 * Comparator for strings. Sorts in descendant order.
	 *
	 * @return Closure(string, string): int
	 */
	public static function stringDesc(): Closure
	{
		return static fn (string $first, string $second): int => strcmp($second, $first);
	}
}
