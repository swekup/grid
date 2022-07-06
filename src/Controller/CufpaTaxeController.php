<?php

namespace App\Controller;

use App\DTOs\CufpaTaxe as CufpaTaxeDto;
use App\Entity\CufpaTaxe;
use App\Service\Grid\GridTrait;
use Doctrine\ORM\QueryBuilder;
use JetBrains\PhpStorm\ArrayShape;

class CufpaTaxeController
{
    use GridTrait;

    public const ROUTE_AJAX  = 'cufpa-taxe-grid-ajax-paginate';
    public const ROUTE_INDEX = 'cufpa-taxe-grid';

    /**
     * @return string
     */
    public function getDtoClass(): string
    {
        return CufpaTaxeDto::class;
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder(): QueryBuilder
    {
        return $this->em->createQueryBuilder()->from(CufpaTaxe::class, 'c0_');
    }

    /**
     * @return array
     */
    #[ArrayShape(['columns' => "array", 'filters' => "array"])]
    public function getConfig(): array
    {
        return [
            'columns' => [
                'id'               => [
                    'title'  => 'Id',
                    'field'  => 'c0_.id',
                    'hidden' => true,
                ],
                'activite'         => [
                    'title'   => 'Activité',
                    'field'   => 'c0_.activite',
                ],
                'taxeType'         => [
                    'title'   => 'Taxe Type',
                    'field'   => 'c0_.taxeType',
                    'default' => true,
                ],
                'montantOperation' => [
                    'title'   => 'Montant operation',
                    'field'   => 'c0_.montantOperation',
                    'default' => true,
                ],
            ],
            'filters' => [
                'montantOperation' => [
                    'title'   => 'Montant operation',
                    'type'    => 'select',
                    'options' => [
                        'euro'     => 'Euro',
                        'pourcent' => 'Pourcentage',
                    ],
                ],
            ],
        ];
    }
}