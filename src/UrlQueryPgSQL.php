<?php

namespace Nerd4ever\UrlQuery\Sql\UrlQueryPgSQL;


use Nerd4ever\UrlQuery\Sql\AbstractUrlQuerySql;

class UrlQueryPgSQL extends AbstractUrlQuerySql
{

    protected function urlQueryFilterBetweenToSql($field, $start, $end): ?string
    {
        return sprintf('%s BETWEEN \'%s\' AND \'%s\'', pg_escape_string($field), pg_escape_string($start), pg_escape_string($end));
    }

    protected function urlQueryFilterContainsToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%%%s%%\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterEqualsToSql($field, $value): ?string
    {
        return sprintf('%s = \'%s\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterFinishToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%%%s\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterGreaterThanToSql($field, $value): ?string
    {
        return sprintf('%s > \'%s\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterGreaterThanOrEqualsToSql($field, $value): ?string
    {
        return sprintf('%s >= \'%s\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterInToSql($field, array $values): ?string
    {
        // TODO: Implement urlQueryFilterInToSql() method.
    }

    protected function urlQueryFilterLessThanToSql($field, $value): ?string
    {
        return sprintf('%s < \'%s\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterLessThanOrEqualsToSql($field, $value): ?string
    {
        return sprintf('%s <= \'%s\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterNilToSql($field): ?string
    {
        // TODO: Implement urlQueryFilterNilToSql() method.
    }

    protected function urlQueryFilterNotEqualsToSql($field, $value): ?string
    {
        return sprintf('%s <> \'%s\'', pg_escape_string($field), pg_escape_string($value));
    }

    protected function urlQueryFilterRegexToSql($field, $value): ?string
    {
        // TODO: Implement urlQueryFilterRegexToSql() method.
    }

    protected function urlQueryFilterStartToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%s%%\'', pg_escape_string($field), pg_escape_string($value));
    }

    public function urlQuerySort($field, $type): ?string
    {
        // TODO: Implement urlQuerySort() method.
    }


    public function urlQueryLimitToSql(?int $limit, ?int $offset)
    {
        // TODO: Implement urlQueryLimitToSql() method.
    }
}