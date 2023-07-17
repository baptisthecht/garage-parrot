<?php

namespace App\Entity;

use App\Repository\AvisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AvisRepository::class)]
class Avis
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $SenderFirstName = null;

    #[ORM\Column(length: 255)]
    private ?string $SenderLastName = null;

    #[ORM\Column]
    private ?bool $isPositive = null;

    #[ORM\Column(length: 255)]
    private ?string $comment = null;

    #[ORM\Column]
    private ?bool $isVerified = null;

    #[ORM\ManyToOne(inversedBy: 'avis')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mark $Note = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSenderFirstName(): ?string
    {
        return $this->SenderFirstName;
    }

    public function setSenderFirstName(string $SenderFirstName): static
    {
        $this->SenderFirstName = $SenderFirstName;

        return $this;
    }

    public function getSenderLastName(): ?string
    {
        return $this->SenderLastName;
    }

    public function setSenderLastName(string $SenderLastName): static
    {
        $this->SenderLastName = $SenderLastName;

        return $this;
    }

    public function isIsPositive(): ?bool
    {
        return $this->isPositive;
    }

    public function setIsPositive(bool $isPositive): static
    {
        $this->isPositive = $isPositive;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): static
    {
        $this->comment = $comment;

        return $this;
    }

    public function isIsVerified(): ?bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }


    public function getNote(): ?Mark
    {
        return $this->Note;
    }

    public function setNote(?Mark $Note): static
    {
        $this->Note = $Note;

        return $this;
    }
}
