<?php

namespace App\Entity;

use App\Repository\EtherystalRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtherystalRepository::class)
 */
class Etherystal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $materialInstanceName;

    /**
     * @ORM\Column(type="text")
     */
    private $property;

    /**
     * @ORM\ManyToOne(targetEntity=Material::class, inversedBy="etherystals")
     */
    private $material;

    /**
     * @ORM\ManyToOne(targetEntity=Color::class, inversedBy="etherystals")
     */
    private $color;

    /**
     * @ORM\ManyToOne(targetEntity=Rarety::class, inversedBy="etherystals")
     */
    private $rarety;

    /**
     * @ORM\Column(type="integer")
     */
    private $itemID;

    /**
     * @ORM\Column(type="integer")
     */
    private $view;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastTimeViewed;

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

    public function getMaterialInstanceName(): ?string
    {
        return $this->materialInstanceName;
    }

    public function setMaterialInstanceName(string $materialInstanceName): self
    {
        $this->materialInstanceName = $materialInstanceName;

        return $this;
    }

    public function getProperty(): ?string
    {
        return $this->property;
    }

    public function setProperty(string $property): self
    {
        $this->property = $property;

        return $this;
    }

    public function getMaterial(): ?Material
    {
        return $this->material;
    }

    public function setMaterial(?Material $material): self
    {
        $this->material = $material;

        return $this;
    }

    public function getColor(): ?Color
    {
        return $this->color;
    }

    public function setColor(?Color $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getRarety(): ?Rarety
    {
        return $this->rarety;
    }

    public function setRarety(?Rarety $rarety): self
    {
        $this->rarety = $rarety;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getItemID(): ?int
    {
        return $this->itemID;
    }

    public function setItemID(int $itemID): self
    {
        $this->itemID = $itemID;

        return $this;
    }

    public function getView(): ?int
    {
        return $this->view;
    }

    public function setView(int $view): self
    {
        $this->view = $view;

        return $this;
    }

    public function getLastTimeViewed(): ?\DateTimeInterface
    {
        return $this->lastTimeViewed;
    }

    public function setLastTimeViewed(?\DateTimeInterface $lastTimeViewed): self
    {
        $this->lastTimeViewed = $lastTimeViewed;

        return $this;
    }
}