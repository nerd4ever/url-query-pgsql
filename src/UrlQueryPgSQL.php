<?php

namespace Nerd4ever\UrlQuery\Sql\UrlQueryPgSQL;


use Nerd4ever\UrlQuery\Model\UrlQuery;
use Nerd4ever\UrlQuery\Sql\AbstractUrlQuerySql;
use PDO;

class UrlQueryPgSQL extends AbstractUrlQuerySql
{

    private $pdo;

    /**
     * UrlQueryPgSQL constructor.
     * @param PDO $pdo
     */
    public function __construct(?PDO $pdo = null)
    {
        $this->pdo = $pdo;
    }

    protected function urlQueryFilterBetweenToSql($field, $start, $end): ?string
    {
        return sprintf('%s BETWEEN \'%s\' AND \'%s\'', $field, $this->quote($start), $this->quote($end));
    }

    protected function urlQueryFilterContainsToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%%%s%%\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterEqualsToSql($field, $value): ?string
    {
        return sprintf('%s = \'%s\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterFinishToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%%%s\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterGreaterThanToSql($field, $value): ?string
    {
        return sprintf('%s > \'%s\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterGreaterThanOrEqualsToSql($field, $value): ?string
    {
        return sprintf('%s >= \'%s\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterInToSql($field, array $values): ?string
    {
        $in = array();
        foreach ($values as $v) $in[] = $this->quote($v);
        $mValues = join("','", $in);
        return sprintf('%s IN (\'%s\')', $field, $mValues);
    }

    protected function urlQueryFilterLessThanToSql($field, $value): ?string
    {
        return sprintf('%s < \'%s\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterLessThanOrEqualsToSql($field, $value): ?string
    {
        return sprintf('%s <= \'%s\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterNilToSql($field): ?string
    {
        return sprintf('%s IS NULL', $field);
    }

    protected function urlQueryFilterNotEqualsToSql($field, $value): ?string
    {
        return sprintf('%s <> \'%s\'', $field, $this->quote($value));
    }

    protected function urlQueryFilterRegexToSql($field, $value): ?string
    {
        return sprintf('%s ~ \'%s\'', $field, $value);
    }

    protected function urlQueryFilterStartToSql($field, $value): ?string
    {
        return sprintf('%s LIKE \'%s%%\'', $field, $this->quote($value));
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

    private function quote($value)
    {
        if ($this->pdo != null) return $this->pdo->quote($value);
        return addslashes($value);
    }
}