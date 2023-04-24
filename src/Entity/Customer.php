<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CustomerRepository::class)]
class Customer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $idnumber = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column]
    private ?int $age = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $occupation = null;

    #[ORM\Column]
    private ?bool $active = null;

    #[ORM\OneToMany(mappedBy: 'idCustomer', targetEntity: Accounts::class, orphanRemoval: true)]
    private Collection $idAccounts;

    #[ORM\OneToMany(mappedBy: 'idCustomer', targetEntity: Transactions::class, orphanRemoval: true)]
    private Collection $idTransactions;

    public function __construct()
    {
        $this->idAccounts = new ArrayCollection();
        $this->idTransactions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

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

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(string $occupation): self
    {
        $this->occupation = $occupation;

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getIdnumber(): ?string
    {
        return $this->idnumber;
    }

    public function setIdnumber(string $idnumber): self
    {
        $this->idnumber = $idnumber;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    /**
     * @return Collection<int, Accounts>
     */
    public function getIdAccounts(): Collection
    {
        return $this->idAccounts;
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
            $idTransaction->setIdCustomer($this);
        }

        return $this;
    }

    public function removeIdTransaction(Transactions $idTransaction): self
    {
        if ($this->idTransactions->removeElement($idTransaction)) {
            // set the owning side to null (unless already changed)
            if ($idTransaction->getIdCustomer() === $this) {
                $idTransaction->setIdCustomer(null);
            }
        }

        return $this;
    }

    public function addIdAccount(Accounts $idAccount): self
    {
        if (!$this->idAccounts->contains($idAccount)) {
            $this->idAccounts->add($idAccount);
            $idAccount->setIdCustomer($this);
        }

        return $this;
    }

    public function removeIdAccount(Accounts $idAccount): self
    {
        if ($this->idAccounts->removeElement($idAccount)) {
            // set the owning side to null (unless already changed)
            if ($idAccount->getIdCustomer() === $this) {
                $idAccount->setIdCustomer(null);
            }
        }

        return $this;
    }
}
