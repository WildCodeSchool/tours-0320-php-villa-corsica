<?php

namespace App\Entity;

use App\Repository\VillaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VillaRepository::class)
 */
class Villa
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
     * @ORM\Column(type="text")
     */
    private $location;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbRoom;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbBed;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbBathroom;

    /**
     * @ORM\Column(type="integer")
     */
    private $capacity;

    /**
     * @ORM\Column(type="integer")
     */
    private $sqm;

    /**
     * @ORM\Column(type="integer")
     */
    private $priceFrom;

    /**
     * @ORM\Column(type="integer")
     */
    private $minimumStay;

    /**
     * @ORM\OneToMany(targetEntity=Image::class, mappedBy="villa", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\OneToMany(targetEntity=LivreDor::class, mappedBy="villa", orphanRemoval=true)
     */
    private $livreDors;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->livreDors = new ArrayCollection();
    }

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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbRoom(): ?int
    {
        return $this->nbRoom;
    }

    public function setNbRoom(int $nbRoom): self
    {
        $this->nbRoom = $nbRoom;

        return $this;
    }

    public function getNbBed(): ?int
    {
        return $this->nbBed;
    }

    public function setNbBed(int $nbBed): self
    {
        $this->nbBed = $nbBed;

        return $this;
    }

    public function getNbBathroom(): ?int
    {
        return $this->nbBathroom;
    }

    public function setNbBathroom(int $nbBathroom): self
    {
        $this->nbBathroom = $nbBathroom;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }

    public function getSqm(): ?int
    {
        return $this->sqm;
    }

    public function setSqm(int $sqm): self
    {
        $this->sqm = $sqm;

        return $this;
    }

    public function getPriceFrom(): ?int
    {
        return $this->priceFrom;
    }

    public function setPriceFrom(int $priceFrom): self
    {
        $this->priceFrom = $priceFrom;

        return $this;
    }

    public function getMinimumStay(): ?int
    {
        return $this->minimumStay;
    }

    public function setMinimumStay(int $minimumStay): self
    {
        $this->minimumStay = $minimumStay;

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setVilla($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getVilla() === $this) {
                $image->setVilla(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LivreDor[]
     */
    public function getLivreDors(): Collection
    {
        return $this->livreDors;
    }

    public function addLivreDor(LivreDor $livreDor): self
    {
        if (!$this->livreDors->contains($livreDor)) {
            $this->livreDors[] = $livreDor;
            $livreDor->setVilla($this);
        }

        return $this;
    }

    public function removeLivreDor(LivreDor $livreDor): self
    {
        if ($this->livreDors->contains($livreDor)) {
            $this->livreDors->removeElement($livreDor);
            // set the owning side to null (unless already changed)
            if ($livreDor->getVilla() === $this) {
                $livreDor->setVilla(null);
            }
        }

        return $this;
    }
}
