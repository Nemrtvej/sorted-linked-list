<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Nemrtvej\SortedLinkedList\CommonComparators;
use Nemrtvej\SortedLinkedList\SortedLinkedList;

$list = SortedLinkedList::int();
/*
 * Magic happens here:
 */
$list->setComparator(CommonComparators::intDesc());

$list->add(1);
$list->add(10);
$list->add(12);
$list->add(3);
$list->add(8);
$list->add(3);
$list->add(5);

/*
 * Will print:
 *
 * 12
 * 10
 * 8
 * 5
 * 3
 * 3
 * 1
 */
foreach ($list->getIterator() as $entry) {
	echo sprintf("%s\n", $entry);
}
