<?php

namespace App\Service\Grid\DataProvider;

use App\Service\Grid\DataProvider\Filter\FilterInterface;
use App\Service\Grid\DataProvider\Order\OrderInterface;
use App\Service\Grid\DataProvider\Search\Search;
use App\Service\Grid\DataProvider\Search\SearchCollection;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Exception;

class OrmDataProvider implements DataProviderInterface
{
    private QueryBuilder $qb;
    private array        $data = [];
    private int          $count;

    public function __construct(QueryBuilder $qb)
    {
        $this->qb = $qb;
    }

    /**
     * @param int|null $startResult
     * @param int|null $maxResult
     * @return void
     * @throws Exception
     */
    public function execute(?int $startResult, ?int $maxResult): void
    {
        $paginator = new Paginator($this->qb->getQuery());
        $paginator->setUseOutputWalkers(false);

        if ($startResult) {
            $paginator->getQuery()->setFirstResult($startResult);
        }

        if ($maxResult) {
            $paginator->getQuery()->setMaxResults($maxResult);
        }

        foreach ($paginator->getIterator() as $rec) {
            $this->data[] = $rec;
        }

        $this->count = $paginator->count();
    }

    public function initSearch(string $value, SearchCollection $search): void
    {
        $conditions = [];
        /** @var Search $column */
        foreach ($search as $column) {
            $conditions[] = $column->getField() . ' LIKE :word';
        }
        $where = implode(' OR ', $conditions);
        $this->qb->where($where);
        $this->qb->setParameter('word', '%' . $value . '%');
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * @param FilterInterface $filter
     * @return void
     */
    public function addFilter(FilterInterface $filter): void
    {
        $this->qb->where($filter->getField() . ' = :' . $filter->getId());
        $this->qb->setParameter($filter->getId(), $filter->getValue());
    }

    /**
     * @param OrderInterface $order
     * @return void
     */
    public function addOrder(OrderInterface $order): void
    {
        $this->qb->orderBy($order->getField(), $order->getOrder());
    }
}