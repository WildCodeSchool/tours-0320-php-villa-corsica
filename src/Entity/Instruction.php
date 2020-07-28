<?php

namespace App\Entity;

use App\Repository\InstructionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstructionRepository::class)
 */
class Instruction
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
    private $contentInstruction;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentInstruction(): ?string
    {
        return $this->contentInstruction;
    }

    public function setContentInstruction(string $contentInstruction): self
    {
        $this->contentInstruction = $contentInstruction;

        return $this;
    }
}
