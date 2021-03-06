<?php

namespace Phinq;

use Closure;
use Phinq\Query\ThenBy;

class OrderedPhinq extends Phinq
{
	public function __construct($collection, array $queries)
	{
		parent::__construct($collection);

		foreach ($queries as $query) {
			$this->addToQueue($query);
		}
	}

	/**
	 * Performs a subsequent sort
	 *
	 * @param Closure $lambda
	 * @param bool $descending Whether to sort in descending order
	 * @return OrderedPhinq
	 */
	public function thenBy(Closure $lambda, $descending = false)
	{
		$this->addToQueue(new ThenBy($this->getLastQuery(), $lambda, $descending));
		return $this;
	}
}