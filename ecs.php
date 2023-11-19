<?php

declare(strict_types=1);

use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;

return static function (ECSConfig $ecsConfig): void {
	$ecsConfig->parallel();
	$ecsConfig->indentation(Option::INDENTATION_TAB);
	$ecsConfig->cacheDirectory('var/ecs');
	$ecsConfig->paths(
		[
			__FILE__,
			__DIR__.'/src',
			__DIR__.'/tests',
			__DIR__.'/examples',
		],
	);

	$callback = include __DIR__.'/config/ecs/strict-coding-style.php';
	$skipRules = $callback($ecsConfig);

	$ecsConfig->skip($skipRules);
};
