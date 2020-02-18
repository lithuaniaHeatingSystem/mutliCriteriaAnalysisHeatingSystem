<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeRepository")
 */
class Type
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
    private $label;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CriteriaType", mappedBy="type")
     */
    private $criteriaTypes;

    public function __construct()
    {
        $this->criteriaTypes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection|CriteriaType[]
     */
    public function getCriteriaTypes(): Collection
    {
        return $this->criteriaTypes;
    }

    public function addCriteriaType(CriteriaType $criteriaType): self
    {
        if (!$this->criteriaTypes->contains($criteriaType)) {
            $this->criteriaTypes[] = $criteriaType;
            $criteriaType->setType($this);
        }

        return $this;
    }

    public function removeCriteriaType(CriteriaType $criteriaType): self
    {
        if ($this->criteriaTypes->contains($criteriaType)) {
            $this->criteriaTypes->removeElement($criteriaType);
            // set the owning side to null (unless already changed)
            if ($criteriaType->getType() === $this) {
                $criteriaType->setType(null);
            }
        }

        return $this;
    }
}
