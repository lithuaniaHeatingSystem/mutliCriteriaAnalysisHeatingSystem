<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CriteriaRepository")
 */
class Criteria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $label;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank()
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $unit;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CriteriaType", mappedBy="criteria", cascade={"persist"})
     */
    private $criteriaTypes;

    public function __construct()
    {
        $this->criteriaTypes = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     *
     * @return $this
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param string $unit
     *
     * @return $this
     */
    public function setUnit(string $unit): self
    {
        $this->unit = $unit;

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
            $criteriaType->setCriteria($this);
        }

        return $this;
    }

    public function removeCriteriaType(CriteriaType $criteriaType): self
    {
        if ($this->criteriaTypes->contains($criteriaType)) {
            $this->criteriaTypes->removeElement($criteriaType);
//            // set the owning side to null (unless already changed)
//            if ($criteriaType->getCriteria() === $this) {
//                $criteriaType->setCriteria(null);
//            }
        }

        return $this;
    }

    /**
     * return Collection|Type[]
     */
    public function getTypes(): Collection
    {
        $types = new ArrayCollection();

        if (count($this->criteriaTypes) > 0) {
            foreach ($this->criteriaTypes as $criteriaType) {
                $types->add($criteriaType->getType());
            }
        }

        return $types;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->label;
    }
}
