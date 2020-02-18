<?php

namespace App\Model;

use App\Entity\CriteriaType;

class WeightModel {

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


}