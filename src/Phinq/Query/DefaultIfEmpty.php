<?php

namespace Phinq\Query;

use Phinq\Query;

class DefaultIfEmpty implements Query
{
	protected $defaultValue;

	public function __construct($defaultValue = null)
	{
		$this->defaultValue = $defaultValue;
	}

	public function execute(array $collection)
	{
		return empty($collection) ? array($this->defaultValue) : $collection;
	}
}