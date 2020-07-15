<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RateRepository::class)
 */
class Rate
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $firstPeriod;

    /**
     * @ORM\Column(type="date")
     */
    private $secondPeriod;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=0)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=Villa::class, inversedBy="rates")
     */
    private $villa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstPeriod(): ?\DateTimeInterface
    {
        return $this->firstPeriod;
    }

    public function setFirstPeriod(\DateTimeInterface $firstPeriod): self
    {
        $this->firstPeriod = $firstPeriod;

        return $this;
    }

    public function getSecondPeriod(): ?\DateTimeInterface
    {
        return $this->secondPeriod;
    }

    public function setSecondPeriod(\DateTimeInterface $secondPeriod): self
    {
        $this->secondPeriod = $secondPeriod;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getVilla(): ?Villa
    {
        return $this->villa;
    }

    public function setVilla(?Villa $villa): self
    {
        $this->villa = $villa;

        return $this;
    }
}
