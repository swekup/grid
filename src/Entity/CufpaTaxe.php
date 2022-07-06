<?php

namespace App\Entity;

use App\Repository\CufpaTaxeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CufpaTaxeRepository::class)
 */
class CufpaTaxe
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @var int
     * @ORM\Column(name="activite_id", type="integer", unique=false, length=10)
     */
    protected int $activite;
    /**
     * @var int
     * @ORM\Column(name="opco_id", type="integer", unique=false, length=10)
     */
    protected int $opco;
    /**
     * @var string
     * @ORM\Column(name="taxe_type_id", type="string", unique=false, length=150)
     */
    protected $taxeType;
    /**
     * @var boolean
     * @ORM\Column(name="is_masse_salariale_totale", type="boolean", unique=false, length=150, nullable=true)
     */
    protected $isMasseSalarialeTotale;
    /**
     * @var boolean
     * @ORM\Column(name="is_masse_salariale_cdd", type="boolean", unique=false, length=150, nullable=true)
     */
    protected $isMasseSalarialeCdd;
    /**
     * @var boolean
     * @ORM\Column(name="is_masse_salariale_intermittent", type="boolean", unique=false, length=150, nullable=true)
     */
    protected $isMasseSalarialeIntermittent;
    /**
     * @var int
     * @ORM\Column(name="effectif_min", type="integer", unique=false, length=10)
     */
    protected int $effectifMin;
    /**
     * @var int
     * @ORM\Column(name="effectif_max", type="integer")
     */
    protected int $effectifMax;
    /**
     * @var string
     * @ORM\Column(name="libelle", type="string", unique=false, length=150)
     */
    protected $libelle;
    /**
     * @var int
     * @ORM\Column(name="montant_valeur", type="integer", unique=false, length=10)
     */
    protected int $montantValeur;
    /**
     * @var string
     * @ORM\Column(name="montant_operation", type="string", unique=false, length=150)
     */
    protected $montantOperation;
    /**
     * @var int
     * @ORM\Column(name="minimum_applicable_valeur", type="integer", unique=false, length=10)
     */
    protected int $minimumApplicableValeur;
    /**
     * @var string|null
     * @ORM\Column(name="minimum_applicable_operation", type="string", unique=false, length=150, nullable=true)
     */
    protected $minimumApplicableOperation;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getActivite(): int
    {
        return $this->activite;
    }

    /**
     * @param int $activite
     */
    public function setActivite(int $activite): void
    {
        $this->activite = $activite;
    }

    /**
     * @return int
     */
    public function getOpco(): int
    {
        return $this->opco;
    }

    /**
     * @param int $opco
     */
    public function setOpco(int $opco): void
    {
        $this->opco = $opco;
    }

    /**
     * @return string
     */
    public function getTaxeType(): string
    {
        return $this->taxeType;
    }

    /**
     * @param string $taxeType
     */
    public function setTaxeType(string $taxeType): void
    {
        $this->taxeType = $taxeType;
    }

    /**
     * @return bool
     */
    public function isMasseSalarialeTotale(): bool
    {
        return $this->isMasseSalarialeTotale;
    }

    /**
     * @param bool $isMasseSalarialeTotale
     */
    public function setIsMasseSalarialeTotale(bool $isMasseSalarialeTotale): void
    {
        $this->isMasseSalarialeTotale = $isMasseSalarialeTotale;
    }

    /**
     * @return bool
     */
    public function isMasseSalarialeCdd(): bool
    {
        return $this->isMasseSalarialeCdd;
    }

    /**
     * @param bool $isMasseSalarialeCdd
     */
    public function setIsMasseSalarialeCdd(bool $isMasseSalarialeCdd): void
    {
        $this->isMasseSalarialeCdd = $isMasseSalarialeCdd;
    }

    /**
     * @return bool
     */
    public function isMasseSalarialeIntermittent(): bool
    {
        return $this->isMasseSalarialeIntermittent;
    }

    /**
     * @param bool $isMasseSalarialeIntermittent
     */
    public function setIsMasseSalarialeIntermittent(bool $isMasseSalarialeIntermittent): void
    {
        $this->isMasseSalarialeIntermittent = $isMasseSalarialeIntermittent;
    }

    /**
     * @return int
     */
    public function getEffectifMin(): int
    {
        return $this->effectifMin;
    }

    /**
     * @param int $effectifMin
     */
    public function setEffectifMin(int $effectifMin): void
    {
        $this->effectifMin = $effectifMin;
    }

    /**
     * @return int
     */
    public function getEffectifMax(): int
    {
        return $this->effectifMax;
    }

    /**
     * @param int $effectifMax
     */
    public function setEffectifMax(int $effectifMax): void
    {
        $this->effectifMax = $effectifMax;
    }

    /**
     * @return string
     */
    public function getLibelle(): string
    {
        return $this->libelle;
    }

    /**
     * @param string $libelle
     */
    public function setLibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    /**
     * @return int
     */
    public function getMontantValeur(): int
    {
        return $this->montantValeur;
    }

    /**
     * @param int $montantValeur
     */
    public function setMontantValeur(int $montantValeur): void
    {
        $this->montantValeur = $montantValeur;
    }

    /**
     * @return string
     */
    public function getMontantOperation(): string
    {
        return $this->montantOperation;
    }

    /**
     * @param string $montantOperation
     */
    public function setMontantOperation(string $montantOperation): void
    {
        $this->montantOperation = $montantOperation;
    }

    /**
     * @return int
     */
    public function getMinimumApplicableValeur(): int
    {
        return $this->minimumApplicableValeur;
    }

    /**
     * @param int $minimumApplicableValeur
     */
    public function setMinimumApplicableValeur(int $minimumApplicableValeur): void
    {
        $this->minimumApplicableValeur = $minimumApplicableValeur;
    }

    /**
     * @return string|null
     */
    public function getMinimumApplicableOperation(): ?string
    {
        return $this->minimumApplicableOperation;
    }

    /**
     * @param string|null $minimumApplicableOperation
     */
    public function setMinimumApplicableOperation(?string $minimumApplicableOperation): void
    {
        $this->minimumApplicableOperation = $minimumApplicableOperation;
    }
}
