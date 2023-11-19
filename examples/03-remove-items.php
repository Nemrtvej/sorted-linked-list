<?php

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

use Nemrtvej\SortedLinkedList\SortedLinkedList;

$list = SortedLinkedList::string(['pizza', 'coffee', 'donut']);

$list->removeElement('coffee');
$list->removeKey(0);

/*
 * Will print:
 *
 * pizza
 */
foreach ($list->getIterator() as $entry) {
	echo sprintf("%s\n", $entry);
}
