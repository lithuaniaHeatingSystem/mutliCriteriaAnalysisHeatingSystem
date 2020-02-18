<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CriteriaTypeRepository")
 */
class CriteriaType
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isPositive;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Criteria", inversedBy="criteriaTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $criteria;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Type", inversedBy="criteriaTypes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function getIsPositive(): ?bool
    {
        return $this->isPositive;
    }

    /**
     * @param bool $isPositive
     *
     * @return $this
     */
    public function setIsPositive(bool $isPositive): self
    {
        $this->isPositive = $isPositive;

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

    /**
     * @return Type|null
     */
    public function getType(): ?Type
    {
        return $this->type;
    }

    /**
     * @param Type|null $type
     *
     * @return $this
     */
    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
