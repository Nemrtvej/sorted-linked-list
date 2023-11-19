<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class ClearTest extends TestCase
{
	public function testClearSomeIntegers(): void
	{
		$list = SortedLinkedList::int();
		$list->add(1);
		$list->add(2);
		$list->clear();

		self::assertSame(0, $list->count());
		self::assertSame([], $list->toArray());
	}

	public function testClearSomeStrings(): void
	{
		$list = SortedLinkedList::string();
		$list->add('a');
		$list->add('b');
		$list->clear();

		self::assertSame(0, $list->count());
		self::assertSame([], $list->toArray());
	}

	public function testClearEmptyList(): void
	{
		$list = SortedLinkedList::int();
		$list->clear();

		self::assertSame(0, $list->count());
		self::assertSame([], $list->toArray());
	}

	public function testClearClearedList(): void
	{
		$list = SortedLinkedList::int();
		$list->clear();
		$list->clear();

		self::assertSame(0, $list->count());
		self::assertSame([], $list->toArray());
	}
}
