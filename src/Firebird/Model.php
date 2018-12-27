<?php namespace Firebird;

use Firebird\Query\Builder;
use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel {
    /**
	 * Get a new query builder instance for the connection.
	 *
	 * @return \Illuminate\Database\Query\Builder
	 */
	protected function newBaseQueryBuilder()
	{
		$connection = $this->getConnection();

		return new Builder(
			$connection, $connection->getQueryGrammar(), $connection->getPostProcessor()
		);
	}
}
