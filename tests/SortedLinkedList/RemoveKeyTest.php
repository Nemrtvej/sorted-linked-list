<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class RemoveKeyTest extends TestCase
{
	public function testItRemovesKeyFromTheBeginning(): void
	{
		$list = $this->createListWithValues();
		$list->removeKey(0);
		self::assertSame([2, 3, 4, 5], $list->toArray());
		self::assertSame(4, $list->count());
	}

	public function testItRemovesKeyFromTheMiddle(): void
	{
		$list = $this->createListWithValues();
		$list->removeKey(3);
		self::assertSame([1, 2, 3, 5], $list->toArray());
		self::assertSame(4, $list->count());
	}

	public function testItRemovesKeyFromTheEnd(): void
	{
		$list = $this->createListWithValues();
		$list->removeKey(4);
		self::assertSame([1, 2, 3, 4], $list->toArray());
		self::assertSame(4, $list->count());
	}

	public function testItRemovesKeyEmptyList(): void
	{
		$list = SortedLinkedList::int();
		$list->removeKey(5);
		self::assertSame([], $list->toArray());
		self::assertSame(0, $list->count());
	}

	public function testItRemovesKeyOutsideOfBounds(): void
	{
		$list = SortedLinkedList::int();
		$list->removeKey(42);
		self::assertSame([], $list->toArray());
		self::assertSame(0, $list->count());
	}

	/**
	 * @return SortedLinkedList<int>
	 */
	private function createListWithValues(): SortedLinkedList
	{
		$list = SortedLinkedList::int();
		$list->add(5);
		$list->add(4);
		$list->add(3);
		$list->add(2);
		$list->add(1);

		return $list;
	}

	public function testItRemovesKeysOnStringListsToo(): void
	{
		$list = SortedLinkedList::string(['a', 'b', 'c']);
		$list->removeKey(1);
		self::assertSame(['a', 'c'], $list->toArray());
		self::assertSame(2, $list->count());
	}
}
