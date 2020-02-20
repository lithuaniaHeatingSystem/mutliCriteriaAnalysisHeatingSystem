<?php

namespace App\Model;

use App\Entity\Criteria;
use App\Entity\CriteriaType;
use App\Entity\Type;

class WeightModel
{
    /**
     * @var integer
     */
    private $weight;

    /**
     * @var CriteriaType
     */
    private $criteriaType;

    /**
     * @return integer
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param integer $weight
     *
     * @return WeightModel
     */
    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * @return CriteriaType
     */
    public function getCriteriaType()
    {
        return $this->criteriaType;
    }

    /**
     * @param CriteriaType $criteriaType
     *
     * @return WeightModel
     */
    public function setCriteriaType($criteriaType): self
    {
        $this->criteriaType = $criteriaType;

        return $this;
    }

    public function isGoodCriteriaType(Criteria $criteria, Type $type){
        return $this->criteriaType->getCriteria()->getId() == $criteria->getId() && $this->criteriaType->getType()->getId() == $type->getId();
    }
}