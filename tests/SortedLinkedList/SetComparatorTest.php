<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use LogicException;
use Nemrtvej\SortedLinkedList\CommonComparators;
use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class SetComparatorTest extends TestCase
{
	public function testItWillSortOtherWay(): void
	{
		$list = SortedLinkedList::int();
		$list->setComparator(CommonComparators::intDesc());

		$list->add(4);
		$list->add(2);
		$list->add(9);
		$list->add(1);
		$list->add(5);

		self::assertSame([9, 5, 4, 2, 1], $list->toArray());
	}

	public function testItWarnsIfComparatorIsSetAfterFirstValue(): void
	{
		$list = SortedLinkedList::int();

		$list->add(1);

		self::expectException(LogicException::class);
		self::expectExceptionMessage('Comparator can be changed only if the list is empty.');

		$list->setComparator(CommonComparators::intDesc());
	}

	public function testItAllowsToChangeComparatorAfterListWasClear(): void
	{
		$list = SortedLinkedList::int();

		$list->add(1);
		$list->removeKey(0);

		$list->setComparator(CommonComparators::intDesc());

		$list->add(4);
		$list->add(2);
		self::assertSame([4, 2], $list->toArray());
	}

	public function testItAllowsToChangeComparatorAfterListWasClearForStringListToo(): void
	{
		$list = SortedLinkedList::string();

		$list->add('a');
		$list->removeKey(0);

		$list->setComparator(CommonComparators::stringDesc());

		$list->add('z');
		$list->add('x');
		self::assertSame(['z', 'x'], $list->toArray());
	}
}
