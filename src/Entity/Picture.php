<?php

namespace App\Entity;

use App\Repository\PictureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PictureRepository::class)
 */
class Picture
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
     * @ORM\ManyToOne(targetEntity=Villa::class, inversedBy="pictures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $villa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

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
