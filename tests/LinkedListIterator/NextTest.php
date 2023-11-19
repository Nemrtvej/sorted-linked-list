<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\LinkedListIterator;

use Nemrtvej\SortedLinkedList\LinkedListIterator;
use Nemrtvej\SortedLinkedList\Node;
use PHPUnit\Framework\TestCase;

final class NextTest extends TestCase
{
	public function testItWontFailOnEmptyCollection(): void
	{
		$iterator = new LinkedListIterator(null);
		$iterator->next();
		self::assertNull($iterator->current());
	}

	public function testItAdvancesTheCursor(): void
	{
		$firstNode = new Node(1, new Node(2, null));

		$iterator = new LinkedListIterator($firstNode);
		self::assertSame(1, $iterator->current());
		$iterator->next();
		self::assertSame(2, $iterator->current());
	}
}
