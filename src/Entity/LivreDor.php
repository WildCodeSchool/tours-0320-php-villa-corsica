<?php

namespace App\Entity;

use App\Repository\LivreDorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LivreDorRepository::class)
 */
class LivreDor
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
     * @ORM\Column(type="string", length=255)
     */
    private $villaName;

    /**
     * @ORM\Column(type="date")
     */
    private $monthStay;

    /**
     * @ORM\Column(type="date")
     */
    private $yearStay;

    /**
     * @ORM\Column(type="text")
     */
    private $commentary;

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

    public function getVillaName(): ?string
    {
        return $this->villaName;
    }

    public function setVillaName(string $villaName): self
    {
        $this->villaName = $villaName;

        return $this;
    }

    public function getMonthStay(): ?\DateTimeInterface
    {
        return $this->monthStay;
    }

    public function setMonthStay(\DateTimeInterface $monthStay): self
    {
        $this->monthStay = $monthStay;

        return $this;
    }

    public function getYearStay(): ?\DateTimeInterface
    {
        return $this->yearStay;
    }

    public function setYearStay(\DateTimeInterface $yearStay): self
    {
        $this->yearStay = $yearStay;

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
}
