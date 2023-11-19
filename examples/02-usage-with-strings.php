<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Nemrtvej\SortedLinkedList\SortedLinkedList;

/**
 * @return SortedLinkedList<string>
 */
function constructData(): SortedLinkedList
{
	$list = SortedLinkedList::string();
	$list->add('foo');
	$list->add('bar');
	$list->add('baz');

	return $list;
}

/**
 * @param SortedLinkedList<string> $data
 */
function printData(SortedLinkedList $data): void
{
	foreach ($data->getIterator() as $entry) {
		echo sprintf("%s\n", $entry);
	}
}

$data = constructData();
/*
 * Will print:
 *
 * bar
 * baz
 * foo
 */
printData($data);
