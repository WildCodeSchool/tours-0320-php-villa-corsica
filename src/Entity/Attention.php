<?php

namespace App\Entity;

use App\Repository\AttentionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AttentionRepository::class)
 */
class Attention
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
    private $contentAttention;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentAttention(): ?string
    {
        return $this->contentAttention;
    }

    public function setContentAttention(string $contentAttention): self
    {
        $this->contentAttention = $contentAttention;

        return $this;
    }
}
