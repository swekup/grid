<?php

namespace App\Service\Grid;

use App\Service\Grid\DataProvider\DataProviderInterface;
use App\Service\Grid\DataProvider\Filter\Filter;
use App\Service\Grid\DataProvider\Order\Order;
use App\Service\Grid\DataProvider\Search\Search;
use App\Service\Grid\DataProvider\Search\SearchCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class GridService
{
    const PAGINATOR_PER_PAGE = 10;
    public ?string               $dtoClass = null;
    public array|object|null     $data;
    public ?string               $globalSearch;
    public array                 $filters;
    public ?string               $orderBy;
    private Config               $config;
    public DataProviderInterface $dataProvider;
    public ?int                  $currentPage;
    private int                  $count;
    private int                  $totalPages;
    private SerializerInterface  $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param Config $config
     */
    public function setConfig(Config $config): void
    {
        $this->config = $config;
    }

    /**
     * @param Request $request
     * @return void
     */
    public function handleRequest(Request $request): void
    {
        $this->globalSearch = $request->get('search');
        $this->initFilters($request->get('filters', []));
        $this->initOrders($request->get('orderBy'));
        $this->initSearch($request->get('search'));
        $this->currentPage = $request->get('page');
    }

    /**
     * @return void
     */
    public function execute(): void
    {
        $this->dataProvider->execute($this->getStartResult(), GridService::PAGINATOR_PER_PAGE);

        $this->data       = $this->dataProvider->getData();
        $this->count      = $this->dataProvider->count();
        $this->totalPages = ceil($this->dataProvider->count() / self::PAGINATOR_PER_PAGE);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        if (is_null($this->dtoClass)) {
            return $this->data;
        }

        $array = [];
        foreach ($this->data as $item) {
            $array[] = new $this->dtoClass($item);
        }

        return $array;
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function totalPages(): int
    {
        return $this->totalPages;
    }

    /**
     * @return int
     */
    private function getStartResult(): int
    {
        $nextPage = (($this->currentPage < $this->totalPages) ? $this->currentPage : $this->totalPages);

        return $this->currentPage === 1 ? 0 : $nextPage * GridService::PAGINATOR_PER_PAGE;
    }

    public function initFilters($filtersValues): void
    {
        foreach ($filtersValues as $filterValue) {
            $filter = new Filter();
            $filter->setField($filterValue['field']);
            $filter->setId($filterValue['id']);
            $filter->setValue($filterValue['value']);

            $this->dataProvider->addFilter($filter);
        }
    }

    public function initOrders($orders): void
    {
        foreach ($orders as $orderConfig) {
            /** @var Column $column */
            $column = $this->config->getColumns()->get($orderConfig['id']);

            $order = new Order();
            $order->setField($column->getField());
            $order->setOrder($orderConfig['order']);

            $this->dataProvider->addOrder($order);
        }
    }

    public function initSearch(string $searchValue): void
    {
        $collection = new SearchCollection();
        /** @var Column $column */
        foreach ($this->config->getColumns() as $column) {
            $search = new Search();
            $search->setField($column->getField());
            $collection->add($search);
        }
        $this->dataProvider->initSearch($searchValue, $collection);
    }

    /**
     * @return string
     */
    public function getConfigSerialize(): string
    {
        return $this->serializer->serialize($this->config, 'json', [AbstractNormalizer::IGNORED_ATTRIBUTES => ['field']]);
    }
}