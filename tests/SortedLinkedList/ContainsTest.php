<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class ContainsTest extends TestCase
{
	public function testItResolvesEmptyList(): void
	{
		$list = SortedLinkedList::int();

		self::assertFalse($list->contains(42));
	}

	public function testItResolvesExistingInteger(): void
	{
		$list = SortedLinkedList::int();
		$list->add(2);
		$list->add(1);

		self::assertTrue($list->contains(1));
	}

	public function testItResolvesNotExistingValue(): void
	{
		$list = SortedLinkedList::int();
		$list->add(2);
		$list->add(1);

		self::assertFalse($list->contains(3));
	}

	public function testItResolvesExistingString(): void
	{
		$list = SortedLinkedList::string();
		$list->add('c');
		$list->add('y');

		self::assertTrue($list->contains('y'));
	}
}
