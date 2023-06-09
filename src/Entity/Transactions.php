<?php

namespace App\Entity;

use App\Repository\TransactionsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionsRepository::class)]
class Transactions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'idTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $idCustomer = null;

    #[ORM\ManyToOne(inversedBy: 'idTransactions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Accounts $idAccount = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(length: 255)]
    private ?string $tradeName = null;

    #[ORM\Column]
    private ?float $value = null;

    #[ORM\Column]
    private ?float $currentBalance = null;

    #[ORM\Column]
    private ?float $finalBalance = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Status $idStatus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCustomer(): ?Customer
    {
        return $this->idCustomer;
    }

    public function setIdCustomer(?Customer $idCustomer): self
    {
        $this->idCustomer = $idCustomer;

        return $this;
    }

    public function getIdAccount(): ?Accounts
    {
        return $this->idAccount;
    }

    public function setIdAccount(?Accounts $idAccount): self
    {
        $this->idAccount = $idAccount;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): self
    {
        $this->created = $created;

        return $this;
    }

    public function getCurrentBalance(): ?float
    {
        return $this->currentBalance;
    }

    public function setCurrentBalance(float $currentBalance): self
    {
        $this->currentBalance = $currentBalance;

        return $this;
    }

    public function getFinalBalance(): ?float
    {
        return $this->finalBalance;
    }

    public function setFinalBalance(float $finalBalance): self
    {
        $this->finalBalance = $finalBalance;

        return $this;
    }

    public function getTradeName(): ?string
    {
        return $this->tradeName;
    }

    public function setTradeName(string $tradeName): self
    {
        $this->tradeName = $tradeName;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getIdStatus(): ?Status
    {
        return $this->idStatus;
    }

    public function setIdStatus(?Status $idStatus): self
    {
        $this->idStatus = $idStatus;

        return $this;
    }
}
