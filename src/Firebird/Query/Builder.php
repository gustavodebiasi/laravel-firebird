<?php namespace Firebird\Query;

use Illuminate\Database\Query\Builder as BaseBuilder;


class Builder extends BaseBuilder {

    /**
	 * AGGREGATE fix
	 *
	 * Get the count of the total records for the paginator.
	 *
	 * @param  array  $columns
	 * @return int
	 */
	public function getCountForPagination($columns = ['*'])
    {
        $results = $this->runPaginationCountQuery($columns);

        // Once we have run the pagination count query, we will get the resulting count and
        // take into account what type of query it was. When there is a group by we will
        // just return the count of the entire results set since that will be correct.
        if (isset($this->groups)) {
            return count($results);
        } elseif (! isset($results[0])) {
            return 0;
        } elseif (is_object($results[0])) {
            return (int) ($results[0]->aggregate ?? $results[0]->AGGREGATE);
        }

        return (int) array_change_key_case((array) $results[0])['aggregate'];
    }

}