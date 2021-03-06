<?php

namespace Phinq\Query;

use Closure;
use Phinq\Grouping;
use Phinq\GroupingDictionary;

class GroupBy extends LambdaDriven
{
	public function execute(array $collection)
	{
		$lambda = $this->getLambdaExpression();
		$dictionary = new GroupingDictionary();

		//lambda expression is abstracted so that the original collection can't be modified since it's passed by reference to array_walk() 
		array_walk($collection, function($value, $key) use (&$dictionary, $lambda) {
			$dictionary[$lambda($value)] = $value;
		});

		$groupings = array();
		
		foreach ($dictionary as $grouping)
		{
			$groupings[] = new Grouping($grouping['value'], $grouping['key']);
		}

		return $groupings;
	}
}