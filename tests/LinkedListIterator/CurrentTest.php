<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\LinkedListIterator;

use Nemrtvej\SortedLinkedList\LinkedListIterator;
use Nemrtvej\SortedLinkedList\Node;
use PHPUnit\Framework\TestCase;

final class CurrentTest extends TestCase
{
	public function testItWontFailOnEmptyCollection(): void
	{
		$iterator = new LinkedListIterator(null);

		self::assertNull($iterator->current());
	}

	public function testItReturnsFirstValue(): void
	{
		$firstNode = new Node(1, new Node(2, null));

		$iterator = new LinkedListIterator($firstNode);

		self::assertSame(1, $iterator->current());
	}
}
