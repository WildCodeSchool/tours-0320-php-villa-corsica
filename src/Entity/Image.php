<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImageRepository::class)
 */
class Image
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Villa::class, inversedBy="images")
     */
    private $Villa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getVilla(): ?Villa
    {
        return $this->Villa;
    }

    public function setVilla(?Villa $Villa): self
    {
        $this->Villa = $Villa;

        return $this;
    }
}
