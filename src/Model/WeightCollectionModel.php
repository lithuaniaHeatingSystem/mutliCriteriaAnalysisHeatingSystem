<?php

namespace App\Model;

use Doctrine\Common\Collections\ArrayCollection;

class WeightCollectionModel
{
    /**
     * @var ArrayCollection
     */
    protected $weightModels;


    public function __construct()
    {
        $this->weightModels = new ArrayCollection();
    }

    /**
     * @return ArrayCollection
     */
    public function getWeightModels()
    {
        return $this->weightModels;
    }

    /**
     * @param $weightModels
     *
     * @return WeightCollectionModel
     */
    public function setWeightModels($weightModels): self
    {
        $this->weightModels = $weightModels;

        return $this;
    }
}