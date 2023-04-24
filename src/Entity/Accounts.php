<?php

namespace App\Entity;

use App\Repository\AccountsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AccountsRepository::class)]
class Accounts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'idAccounts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Customer $idCustomer = null;

    #[ORM\Column(length: 255)]
    private ?string $number = null;

    #[ORM\Column]
    private ?float $balance = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $activation = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'idAccount', targetEntity: Transactions::class, orphanRemoval: true)]
    private Collection $idTransactions;

    public function __construct()
    {
        $this->idTransactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBalance(): ?float
    {
        return $this->balance;
    }

    public function setBalance(float $balance): self
    {
        $this->balance = $balance;

        return $this;
    }

    public function getActivation(): ?\DateTimeInterface
    {
        return $this->activation;
    }

    public function setActivation(\DateTimeInterface $activation): self
    {
        $this->activation = $activation;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function isActive(): ?bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

    /**
     * @return Collection<int, Transactions>
     */
    public function getIdTransactions(): Collection
    {
        return $this->idTransactions;
    }

    public function addIdTransaction(Transactions $idTransaction): self
    {
        if (!$this->idTransactions->contains($idTransaction)) {
            $this->idTransactions->add($idTransaction);
            $idTransaction->setIdAccount($this);
        }

        return $this;
    }

    public function removeIdTransaction(Transactions $idTransaction): self
    {
        if ($this->idTransactions->removeElement($idTransaction)) {
            // set the owning side to null (unless already changed)
            if ($idTransaction->getIdAccount() === $this) {
                $idTransaction->setIdAccount(null);
            }
        }

        return $this;
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

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }
}
