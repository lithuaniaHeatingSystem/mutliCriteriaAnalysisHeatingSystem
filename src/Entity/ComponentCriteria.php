<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @ORM\Column(type="float", precision=10, scale=2)
     *
     * @Assert\NotBlank(groups={"second_step"})
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }

    /**
     * @param float $value
     *
     * @return $this
     */
    public function setValue(float $value): self
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
}
