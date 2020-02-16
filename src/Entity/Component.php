<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComponentRepository")
 */
class Component
{
    const HEATING_TYPE = 1,
        VALVE_TYPE = 2,
        PIPE_TYPE = 3,
        THERMOSTATIC_VALVE_TYPE = 4,
        CIRCULATION_PUMP_TYPE = 5;

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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $link;

    /**
     * @ORM\Column(type="integer")
     */
    private $type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComponentCriteria", mappedBy="component", orphanRemoval=true)
     */
    private $componentCriterias;

    /**
     * Component constructor.
     */
    public function __construct()
    {
        $this->componentCriterias = new ArrayCollection();
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
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     *
     * @return $this
     */
    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return $this
     */
    public function setType(int $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|ComponentCriteria[]
     */
    public function getComponentCriterias(): Collection
    {
        return $this->componentCriterias;
    }

    /**
     * @param ComponentCriteria $componentCriteria
     *
     * @return $this
     */
    public function addComponentCriteria(ComponentCriteria $componentCriteria): self
    {
        if (!$this->componentCriterias->contains($componentCriteria)) {
            $this->componentCriterias[] = $componentCriteria;
            $componentCriteria->setComponent($this);
        }

        return $this;
    }

    /**
     * @param ComponentCriteria $componentCriteria
     *
     * @return $this
     */
    public function removeComponentCriteria(ComponentCriteria $componentCriteria): self
    {
        if ($this->componentCriterias->contains($componentCriteria)) {
            $this->componentCriterias->removeElement($componentCriteria);
            // set the owning side to null (unless already changed)
            if ($componentCriteria->getComponent() === $this) {
                $componentCriteria->setComponent(null);
            }
        }

        return $this;
    }
}
