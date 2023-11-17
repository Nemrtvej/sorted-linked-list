<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\LinkedListIterator;

use Nemrtvej\SortedLinkedList\LinkedListIterator;
use Nemrtvej\SortedLinkedList\Node;
use PHPUnit\Framework\TestCase;

class KeyTest extends TestCase
{
	public function testItWontFailOnEmptyCollection(): void
	{
		$iterator = new LinkedListIterator(null);

		self::assertNull($iterator->key());
	}

	public function testItAdvancesKeys(): void
	{
		$firstNode = new Node('a', new Node('b', null));

		$iterator = new LinkedListIterator($firstNode);

		self::assertSame(0, $iterator->key());
		$iterator->next();
		self::assertSame(1, $iterator->key());
	}
}
