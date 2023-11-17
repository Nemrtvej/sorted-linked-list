<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class CountTest extends TestCase
{
	public function testSingleItemProducesLength1(): void
	{
		$list = new SortedLinkedList();
		$list->add(1);

		self::assertSame(1, $list->count());
	}

	public function testTwoItemsProducesLength2(): void
	{
		$list = new SortedLinkedList();
		$list->add(2);
		$list->add(1);

		self::assertSame(2, $list->count());
	}

	public function test6ItemsProduceLength6(): void
	{
		$list = new SortedLinkedList();
		$list->add(15);
		$list->add(4);
		$list->add(42);
		$list->add(8);
		$list->add(23);
		$list->add(16);

		self::assertSame(6, $list->count());
	}

	public function testEmptyListReturnLength0(): void
	{
		$list = new SortedLinkedList();

		self::assertSame(0, $list->count());
	}
}
