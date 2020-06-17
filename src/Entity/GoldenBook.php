<?php

namespace App\Entity;

use App\Repository\GoldenBookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GoldenBookRepository::class)
 */
class GoldenBook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="date")
     */
    private $departureDate;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $commentary;

    /**
     * @ORM\ManyToOne(targetEntity=Villa::class, inversedBy="goldenBooks")
     */
    private $villa;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDepartureDate(): ?\DateTimeInterface
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTimeInterface $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function getCommentary(): ?string
    {
        return $this->commentary;
    }

    public function setCommentary(string $commentary): self
    {
        $this->commentary = $commentary;

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
