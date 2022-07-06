<?php

namespace App\DTOs;

use App\Entity\CufpaTaxe as CufpaTaxeEntity;

class CufpaTaxe
{
    public int     $id;
    public int     $activite;
    public int     $opco;
    public string  $taxeType;
    public bool    $isMasseSalarialeTotale;
    public bool    $isMasseSalarialeCdd;
    public bool    $isMasseSalarialeIntermittent;
    public int     $effectifMin;
    public ?int    $effectifMax;
    public string  $libelle;
    public int     $montantValeur;
    public string  $montantOperation;
    public ?int    $minimumApplicableValeur = 0;
    public ?string $minimumApplicableOperation;

    /**
     * @param CufpaTaxeEntity $cufpaTaxe
     */
    public function __construct(CufpaTaxeEntity $cufpaTaxe)
    {
        $this->id                           = $cufpaTaxe->getId();
        $this->activite                     = $cufpaTaxe->getActivite();
        $this->opco                         = $cufpaTaxe->getOpco();
        $this->taxeType                     = $cufpaTaxe->getTaxeType();
        $this->isMasseSalarialeTotale       = $cufpaTaxe->isMasseSalarialeTotale();
        $this->isMasseSalarialeCdd          = $cufpaTaxe->isMasseSalarialeCdd();
        $this->isMasseSalarialeIntermittent = $cufpaTaxe->isMasseSalarialeIntermittent();
        $this->effectifMin                  = $cufpaTaxe->getEffectifMin();
        $this->effectifMax                  = 300;
        $this->libelle                      = $cufpaTaxe->getLibelle();
        $this->montantValeur                = $cufpaTaxe->getMontantValeur();
        $this->montantOperation             = $cufpaTaxe->getMontantOperation();
        $this->minimumApplicableValeur      = 0;
        $this->minimumApplicableOperation   = $cufpaTaxe->getMinimumApplicableOperation();
    }
}