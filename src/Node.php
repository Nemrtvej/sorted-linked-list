<?php

declare(strict_types=1);

namespace Nemrtvej\SortedLinkedList;

final class Node
{
	public function __construct(
		public readonly string $value,
	) {
	}
}
