<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColorRepository::class)
 */
class Color
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $colorPreview;

    /**
     * @ORM\Column(type="smallint")
     */
    private $colorID;

    /**
     * @ORM\OneToMany(targetEntity=Etherystal::class, mappedBy="color")
     */
    private $etherystals;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    public function __construct()
    {
        $this->etherystals = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getColorPreview(): ?string
    {
        return $this->colorPreview;
    }

    public function setColorPreview(string $colorPreview): self
    {
        $this->colorPreview = $colorPreview;

        return $this;
    }

    public function getColorID(): ?int
    {
        return $this->colorID;
    }

    public function setColorID(int $colorID): self
    {
        $this->colorID = $colorID;

        return $this;
    }

    /**
     * @return Collection|Etherystal[]
     */
    public function getEtherystals(): Collection
    {
        return $this->etherystals;
    }

    public function addEtherystal(Etherystal $etherystal): self
    {
        if (!$this->etherystals->contains($etherystal)) {
            $this->etherystals[] = $etherystal;
            $etherystal->setColor($this);
        }

        return $this;
    }

    public function removeEtherystal(Etherystal $etherystal): self
    {
        if ($this->etherystals->removeElement($etherystal)) {
            // set the owning side to null (unless already changed)
            if ($etherystal->getColor() === $this) {
                $etherystal->setColor(null);
            }
        }

        return $this;
    }
    

    public function __toString()
    {
        return (string) $this->colorID;
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
}