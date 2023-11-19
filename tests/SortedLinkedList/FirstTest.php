<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\SortedLinkedList;

use Nemrtvej\SortedLinkedList\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class FirstTest extends TestCase
{
	public function testItWontFailOnEmptyList(): void
	{
		$list = SortedLinkedList::int();

		self::assertNull($list->getFirst());
	}

	public function testItReturnsSmallestValue(): void
	{
		$list = SortedLinkedList::int();
		$list->add(2);
		$list->add(1);

		self::assertSame(1, $list->getFirst());
	}
}
