<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\LinkedListIterator;

use Nemrtvej\SortedLinkedList\LinkedListIterator;
use Nemrtvej\SortedLinkedList\Node;
use PHPUnit\Framework\TestCase;

final class RewindTest extends TestCase
{
	public function testItWontFailOnEmptyCollection(): void
	{
		$iterator = new LinkedListIterator(null);
		$iterator->rewind();
		self::assertNull($iterator->current());
	}

	public function testItRewindsTheCursor(): void
	{
		$firstNode = new Node('a', new Node('b', null));

		$iterator = new LinkedListIterator($firstNode);
		self::assertSame('a', $iterator->current());
		self::assertSame(0, $iterator->key());
		$iterator->next();
		self::assertSame('b', $iterator->current());
		self::assertSame(1, $iterator->key());
		$iterator->rewind();
		self::assertSame('a', $iterator->current());
		self::assertSame(0, $iterator->key());
	}
}
