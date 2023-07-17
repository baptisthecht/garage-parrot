<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Brand = null;

    #[ORM\Column(length: 255)]
    private ?string $Model = null;

    #[ORM\Column]
    private ?float $Price = null;

    #[ORM\Column]
    private ?int $Year = null;

    #[ORM\Column]
    private ?int $KM = null;

    #[ORM\Column(length: 255)]
    private ?string $MainImage = null;

    #[ORM\Column]
    private ?bool $Climatisation = null;

    #[ORM\Column]
    private ?bool $Centralisation = null;

    #[ORM\Column]
    private ?bool $RegLimVitesse = null;

    #[ORM\Column]
    private ?bool $Auto = null;

    #[ORM\Column]
    private ?bool $ToitOuvrant = null;

    #[ORM\Column(length: 1000)]
    private ?string $commentaire = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img2 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img3 = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $img4 = null;

    #[ORM\Column(length: 255)]
    private ?string $power = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Carburant $energy = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBrand(): ?string
    {
        return $this->Brand;
    }

    public function setBrand(string $Brand): static
    {
        $this->Brand = $Brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->Model;
    }

    public function setModel(string $Model): static
    {
        $this->Model = $Model;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->Price;
    }

    public function setPrice(float $Price): static
    {
        $this->Price = $Price;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->Year;
    }

    public function setYear(int $Year): static
    {
        $this->Year = $Year;

        return $this;
    }

    public function getKM(): ?int
    {
        return $this->KM;
    }

    public function setKM(int $KM): static
    {
        $this->KM = $KM;

        return $this;
    }

    public function getMainImage(): ?string
    {
        return $this->MainImage;
    }

    public function setMainImage(string $MainImage): static
    {
        $this->MainImage = $MainImage;

        return $this;
    }

    public function isClimatisation(): ?bool
    {
        return $this->Climatisation;
    }

    public function setClimatisation(bool $Climatisation): static
    {
        $this->Climatisation = $Climatisation;

        return $this;
    }

    public function isCentralisation(): ?bool
    {
        return $this->Centralisation;
    }

    public function setCentralisation(bool $Centralisation): static
    {
        $this->Centralisation = $Centralisation;

        return $this;
    }

    public function isRegLimVitesse(): ?bool
    {
        return $this->RegLimVitesse;
    }

    public function setRegLimVitesse(bool $RegLimVitesse): static
    {
        $this->RegLimVitesse = $RegLimVitesse;

        return $this;
    }

    public function isAuto(): ?bool
    {
        return $this->Auto;
    }

    public function setAuto(bool $Auto): static
    {
        $this->Auto = $Auto;

        return $this;
    }

    public function isToitOuvrant(): ?bool
    {
        return $this->ToitOuvrant;
    }

    public function setToitOuvrant(bool $ToitOuvrant): static
    {
        $this->ToitOuvrant = $ToitOuvrant;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getImg2(): ?string
    {
        return $this->img2;
    }

    public function setImg2(?string $img2): static
    {
        $this->img2 = $img2;

        return $this;
    }

    public function getImg3(): ?string
    {
        return $this->img3;
    }

    public function setImg3(?string $img3): static
    {
        $this->img3 = $img3;

        return $this;
    }

    public function getImg4(): ?string
    {
        return $this->img4;
    }

    public function setImg4(?string $img4): static
    {
        $this->img4 = $img4;

        return $this;
    }

    public function getPower(): ?string
    {
        return $this->power;
    }

    public function setPower(string $power): static
    {
        $this->power = $power;

        return $this;
    }

    public function getEnergy(): ?Carburant
    {
        return $this->energy;
    }

    public function setEnergy(?Carburant $energy): static
    {
        $this->energy = $energy;

        return $this;
    }

}
