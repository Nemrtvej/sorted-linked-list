<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class AddTest extends TestCase
{
	public function testItAddsToEmptyList(): void
	{
		$list = SortedLinkedList::int();
		$list->add(1);

		self::assertSame(1, $list->getFirst());
	}

	public function testItAddsSecondValueToBeginningIfItIsLower(): void
	{
		$list = SortedLinkedList::int();
		$list->add(2);
		$list->add(1);

		self::assertSame(1, $list->getFirst());
	}

	public function testItAddsSecondValueToEndIfItIsHigher(): void
	{
		$list = SortedLinkedList::int();
		$list->add(1);
		$list->add(2);

		self::assertSame(1, $list->getFirst());
	}

	public function testItKeepsValuesSorted(): void
	{
		$list = SortedLinkedList::int();
		$list->add(15);
		$list->add(4);
		$list->add(42);
		$list->add(8);
		$list->add(23);
		$list->add(16);

		self::assertSame([4, 8, 15, 16, 23, 42], iterator_to_array($list->toValues(), false));
	}

	public function testEmptyCollectionHasNoValues(): void
	{
		$list = SortedLinkedList::int();

		self::assertSame([], iterator_to_array($list->toValues(), false));
	}
}
