<?php

declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

if (
    ini_get('zend.assertions') !== '1'
    || ini_get('assert.exception') !== '1'
) {
    throw new \Exception('Assertions are not correctly configured. Set both "zend.assertions" and "assert.exception" to "1" in php.ini.');
}

