<?php

declare(strict_types=1);

use Nemrtvej\SortedLinkedList\SortedLinkedList;

/**
 * @return SortedLinkedList<int>
 */
function constructData(): SortedLinkedList
{
	$list = SortedLinkedList::int();
	$list->add(3);
	$list->add(2);
	$list->add(1);

	return $list;
}

/**
 * @param SortedLinkedList<int> $data
 */
function printData(SortedLinkedList $data): void
{
	foreach ($data->getIterator() as $entry) {
		echo sprintf("%s\n", $entry);
	}
}

$data = constructData();
printData($data);
