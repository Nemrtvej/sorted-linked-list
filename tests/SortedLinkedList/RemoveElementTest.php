<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class RemoveElementTest extends TestCase
{
	public function testItRemovesExistingItemFromBeginningOfList(): void
	{
		$list = $this->createListWithThreeUniqueItems();
		$list->removeElement(1);
		self::assertSame(2, $list->count());
		self::assertSame(2, $list->getFirst());
		self::assertSame([2, 3], $list->toArray());
	}

	public function testItRemovesExistingItemFromMiddleOfList(): void
	{
		$list = $this->createListWithThreeUniqueItems();
		$list->removeElement(2);
		self::assertSame(2, $list->count());
		self::assertSame(1, $list->getFirst());
		self::assertSame([1, 3], $list->toArray());
	}

	public function testItRemovesExistingItemFromEndOfList(): void
	{
		$list = $this->createListWithThreeUniqueItems();
		$list->removeElement(3);
		self::assertSame([1, 2], $list->toArray());
		self::assertSame(2, $list->count());
		self::assertSame(1, $list->getFirst());
	}

	public function testItRemovesMultipleCopiesWithSameValueFromTheBeginning(): void
	{
		$list = $this->createListWithThreeGroupsofItems();
		self::assertSame([1, 1, 2, 2, 2, 3, 3, 3], $list->toArray());
		self::assertSame(8, $list->count());
		$list->removeElement(1);
		self::assertSame([2, 2, 2, 3, 3, 3], $list->toArray());
		self::assertSame(6, $list->count());
	}

	public function testItRemovesMultipleCopiesWithSameValueFromTheMiddle(): void
	{
		$list = $this->createListWithThreeGroupsofItems();
		self::assertSame([1, 1, 2, 2, 2, 3, 3, 3], $list->toArray());
		self::assertSame(8, $list->count());
		$list->removeElement(2);
		self::assertSame([1, 1, 3, 3, 3], $list->toArray());
		self::assertSame(5, $list->count());
	}

	public function testItRemovesMultipleCopiesWithSameValueFromTheEnd(): void
	{
		$list = $this->createListWithThreeGroupsofItems();
		self::assertSame([1, 1, 2, 2, 2, 3, 3, 3], $list->toArray());
		self::assertSame(8, $list->count());
		$list->removeElement(3);
		self::assertSame([1, 1, 2, 2, 2], $list->toArray());
		self::assertSame(5, $list->count());
	}

	public function testItRemovesTheOnlyItem(): void
	{
		$list = SortedLinkedList::int();
		$list->add(1);

		self::assertSame(1, $list->count());
		$list->removeElement(1);
		self::assertSame(0, $list->count());
		self::assertNull($list->getFirst());
	}

	public function testItDoesNotFailOnRemovalFromEmptyList(): void
	{
		$list = SortedLinkedList::int();

		self::assertSame(0, $list->count());
		$list->removeElement(3);
		self::assertSame(0, $list->count());
	}

	/**
	 * @return SortedLinkedList<int>
	 */
	private function createListWithThreeUniqueItems(): SortedLinkedList
	{
		$list = SortedLinkedList::int();
		$list->add(3);
		$list->add(2);
		$list->add(1);

		return $list;
	}

	/**
	 * @return SortedLinkedList<int>
	 */
	private function createListWithThreeGroupsofItems(): SortedLinkedList
	{
		$list = SortedLinkedList::int();
		$list->add(1);
		$list->add(1);
		$list->add(2);
		$list->add(2);
		$list->add(2);
		$list->add(3);
		$list->add(3);
		$list->add(3);

		return $list;
	}

	public function testItTransformsPizzaToApiLikeAProperDeveloper(): void
	{
		$list = SortedLinkedList::string();
		$riggedComparator = static function (string $first, string $last): int {
			/*
			 * Rig the comparator in a way that the result is ordered in a way that "api" is spelled instead of "aip".
			 */
			if ($first === 'i') {
				return 1;
			}
			if ($last === 'i') {
				return -1;
			}

			return strcmp($first, $last);
		};

		$list->setComparator($riggedComparator);

		$list->add('p');
		$list->add('i');
		$list->add('z');
		$list->add('z');
		$list->add('a');

		$list->removeElement('z');

		self::assertSame(['a', 'p', 'i'], $list->toArray()); // Hoooray! :)
		self::assertSame(3, $list->count());
	}
}
