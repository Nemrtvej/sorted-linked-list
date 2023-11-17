<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList\Tests;

use Nemrtvej\SortedLinkedList\Node;
use PHPUnit\Framework\TestCase;

final class NodeTest extends TestCase
{
	public function testItReturnsValue(): void
	{
		$value = "42";
		$node = new Node($value);

		self::assertEquals($value, $node->value);
	}
}
