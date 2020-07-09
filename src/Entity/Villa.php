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
     * @ORM\OneToMany(targetEntity=Picture::class, mappedBy="villa", orphanRemoval=true)
     */
    private $pictures;

    /**
     * @ORM\Column(type="text")
     */
    private $poster;

    /**
     * @ORM\OneToMany(targetEntity=GoldenBook::class, mappedBy="villa")
     */
    private $goldenBooks;

    /**
     * @ORM\Column(type="string", length=400)
     */
    private $price;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
        $this->goldenBooks = new ArrayCollection();
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

    /**
     * @return Collection|Picture[]
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Picture $picture): self
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures[] = $picture;
            $picture->setVilla($this);
        }

        return $this;
    }

    public function removePicture(Picture $picture): self
    {
        if ($this->pictures->contains($picture)) {
            $this->pictures->removeElement($picture);
            // set the owning side to null (unless already changed)
            if ($picture->getVilla() === $this) {
                $picture->setVilla(null);
            }
        }

        return $this;
    }

    public function getPoster(): ?string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): self
    {
        $this->poster = $poster;

        return $this;
    }

    /**
     * @return Collection|GoldenBook[]
     */
    public function getGoldenBooks(): Collection
    {
        return $this->goldenBooks;
    }

    public function addGoldenBook(GoldenBook $goldenBook): self
    {
        if (!$this->goldenBooks->contains($goldenBook)) {
            $this->goldenBooks[] = $goldenBook;
            $goldenBook->setVilla($this);
        }

        return $this;
    }

    public function removeGoldenBook(GoldenBook $goldenBook): self
    {
        if ($this->goldenBooks->contains($goldenBook)) {
            $this->goldenBooks->removeElement($goldenBook);
            // set the owning side to null (unless already changed)
            if ($goldenBook->getVilla() === $this) {
                $goldenBook->setVilla(null);
            }
        }

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
}
