<?php

namespace App\Entity;

use App\Repository\ConditionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConditionRepository::class)
 * @ORM\Table(name="`condition`")
 */
class Condition
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
    private $contentCondition;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContentCondition(): ?string
    {
        return $this->contentCondition;
    }

    public function setContentCondition(string $contentCondition): self
    {
        $this->contentCondition = $contentCondition;

        return $this;
    }
}
