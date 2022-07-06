<?php

namespace App\Controller\Grid\Factory;

use App\Service\Grid\Config;
use Doctrine\Common\Collections\ArrayCollection;

class ConfigFactory
{
    public static function create(array $arrayConfig): Config
    {
        $config  = new Config();
        $columns = ColumnFactory::createArrayCollection($arrayConfig['columns']);
        $filters = FilterFactory::create($arrayConfig['filters']);
        $config->setColumns($columns);
        $config->setFilters($filters);

        return $config;
    }
}