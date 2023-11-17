<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests\LinkedListIterator;

use Nemrtvej\SortedLinkedList\LinkedListIterator;
use Nemrtvej\SortedLinkedList\Node;
use PHPUnit\Framework\TestCase;

final class ValidTest extends TestCase
{
	public function testItWontFailOnEmptyCollection(): void
	{
		$iterator = new LinkedListIterator(null);

		self::assertFalse($iterator->valid());
	}

	public function testItAdvancesKeys(): void
	{
		$firstNode = new Node('a', new Node('b', null));

		$iterator = new LinkedListIterator($firstNode);

		self::assertTrue($iterator->valid());
		$iterator->next();
		self::assertTrue($iterator->valid());
		$iterator->next();
		self::assertFalse($iterator->valid());
	}
}
