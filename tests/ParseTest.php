<?php

namespace Nerd4ever\UrlQuery\Sql\UrlQueryPgSQL\Tests;

use Nerd4ever\UrlQuery\Exception\UrlQuerySqlException;
use Nerd4ever\UrlQuery\Model\CriteriaBetween;
use Nerd4ever\UrlQuery\Model\ICriteria;
use Nerd4ever\UrlQuery\Model\UrlQuery;
use Nerd4ever\UrlQuery\Sql\UrlQueryPgSQL\UrlQueryPgSQL;
use PHPUnit\Framework\TestCase;

class ParseTest extends TestCase
{
    /**
     * @dataProvider getParseSqlProvider
     * @param string $queryString
     * @param string $field
     * @param array $alias
     * @param string | null $expected
     */
    public function testParse(string $queryString, string $field, array $alias, ?string $expected)
    {
        $parser = new UrlQueryPgSQL();
        try {
            $urlQuery = new UrlQuery();
            $urlQuery->parser($queryString);
            $this->assertSame($expected, $parser->urlQueryFilterToSql($urlQuery->getFilter($field), $alias));
        } catch (UrlQuerySqlException $ex) {
            $this->fail($ex->getMessage());
        }
    }

    public function getParseSqlProvider()
    {
        $alias = ['data1' => 'e1.data1'];
        return [
            'between success' => ['data1=between:3,5', 'data1', $alias, "e1.data1 BETWEEN '3' AND '5'"],
            'like success' => ['data1=contains:3', 'data1', $alias, "e1.data1 LIKE '%3%'"],
            'equals success' => ['data1=3', 'data1', $alias, "e1.data1 = '3'"],
            'less than success' => ['data1=lt:3', 'data1', $alias, "e1.data1 < '3'"],
            'less than or equals success' => ['data1=le:3', 'data1', $alias, "e1.data1 <= '3'"],
            'finish success' => ['data1=finish:3', 'data1', $alias, "e1.data1 LIKE '%3'"],
            'start success' => ['data1=start:3', 'data1', $alias, "e1.data1 LIKE '3%'"],
            'not equals success' => ['data1=ne:3', 'data1', $alias, "e1.data1 <> '3'"],
            'greater than or equals success' => ['data1=ge:3', 'data1', $alias, "e1.data1 >= '3'"],
            'greater than success' => ['data1=gt:3', 'data1', $alias, "e1.data1 > '3'"],
            'in success' => ['data1=in:3,4,5', 'data1', $alias, "e1.data1 IN ('3','4','5')"],
            'nil success' => ['data1=nil:', 'data1', $alias, "e1.data1 IS NULL"],
            'regex success' => ['data1=regex:[0-9]', 'data1', $alias, "e1.data1 ~ '[0-9]'"],
        ];
    }
}