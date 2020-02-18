<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComponentCriteriaRepository")
 */
class ComponentCriteria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Component", inversedBy="componentCriterias")
     * @ORM\JoinColumn(nullable=false)
     */
    private $component;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criteria")
     * @ORM\JoinColumn(nullable=false)
     */
    private $criteria;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPositive;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getValue(): ?int
    {
        return $this->value;
    }

    /**
     * @param int $value
     *
     * @return $this
     */
    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return Component|null
     */
    public function getComponent(): ?Component
    {
        return $this->component;
    }

    /**
     * @param Component|null $component
     *
     * @return $this
     */
    public function setComponent(?Component $component): self
    {
        $this->component = $component;

        return $this;
    }

    /**
     * @return Criteria|null
     */
    public function getCriteria(): ?Criteria
    {
        return $this->criteria;
    }

    /**
     * @param Criteria|null $criteria
     *
     * @return $this
     */
    public function setCriteria(?Criteria $criteria): self
    {
        $this->criteria = $criteria;

        return $this;
    }

    public function getIsPositive(): ?bool
    {
        return $this->isPositive;
    }

    public function setIsPositive(bool $isPositive): self
    {
        $this->isPositive = $isPositive;

        return $this;
    }
}
