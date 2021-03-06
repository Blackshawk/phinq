<?php

namespace Phinq\Query;

use Closure;

abstract class Ordered extends LambdaDriven
{
	private $descending;

	public function __construct(Closure $lambda, $descending = false)
	{
		parent::__construct($lambda);
		$this->descending = (bool)$descending;
	}

	public final function isDescending()
	{
		return $this->descending;
	}

	public final function execute(array $collection)
	{
		usort($collection, $this->getSortingCallback());
		return $collection;
	}

	/**
	 * @return Closure
	 */
	public abstract function getSortingCallback();
}