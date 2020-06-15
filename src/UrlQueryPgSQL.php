<?php

namespace Nerd4ever\UrlQuery\Sql\UrlQueryPgSQL;


use Nerd4ever\UrlQuery\Model\UrlQuery;
use Nerd4ever\UrlQuery\Sql\AbstractUrlQuerySql;

class UrlQueryPgSQL extends AbstractUrlQuerySql
{

    protected function urlQueryFilterBetweenToSql($field, $start, $end): ?string
    {
        return sprintf('%s BETWEEN \'%s\' AND \'%s\'', $field, pg_escape_string($start), pg_escape_string($end));
    }

    protected function urlQueryFilterContainsToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%%%s%%\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterEqualsToSql($field, $value): ?string
    {
        return sprintf('%s = \'%s\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterFinishToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%%%s\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterGreaterThanToSql($field, $value): ?string
    {
        return sprintf('%s > \'%s\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterGreaterThanOrEqualsToSql($field, $value): ?string
    {
        return sprintf('%s >= \'%s\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterInToSql($field, array $values): ?string
    {
        $in = array();
        foreach ($values as $v) $in[] = pg_escape_string($v);
        $mValues = join("','", $in);
        return sprintf('%s IN (\'%s\')', pg_escape_string($field), $mValues);
    }

    protected function urlQueryFilterLessThanToSql($field, $value): ?string
    {
        return sprintf('%s < \'%s\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterLessThanOrEqualsToSql($field, $value): ?string
    {
        return sprintf('%s <= \'%s\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterNilToSql($field): ?string
    {
        return sprintf('%s IS NULL', $field);
    }

    protected function urlQueryFilterNotEqualsToSql($field, $value): ?string
    {
        return sprintf('%s <> \'%s\'', $field, pg_escape_string($value));
    }

    protected function urlQueryFilterRegexToSql($field, $value): ?string
    {
        return sprintf('%s ~ \'%s\'', $field, $value);
    }

    protected function urlQueryFilterStartToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%s%%\'', $field, pg_escape_string($value));
    }

    public function urlQuerySort($field, $type): ?string
    {
        // TODO: Implement urlQuerySort() method.
    }


    public function urlQueryLimitToSql(UrlQuery $urlQuery)
    {
        if ($urlQuery->getLimit() == null) return '';
        $mSql = sprintf('LIMIT %d', intval($urlQuery->getLimit()));
        if ($urlQuery->getOffset() != null) {
            $mSql = sprintf(' OFFSET %d', intval($urlQuery->getOffset()));
        }
        return $mSql;
    }
}