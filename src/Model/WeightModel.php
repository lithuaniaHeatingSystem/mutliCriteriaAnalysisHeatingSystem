<?php
/**
 * Created by PhpStorm.
 * User: simoncollin
 * Date: 2020-02-17
 * Time: 14:39
 */

use App\Entity\ComponentCriteria;

class WeightModel {

    private $weight;
    private $componentCriteria;

    /**
     * WeightModel constructor.
     * @param $weight
     * @param $componentCriteria
     */
    public function __construct($weight, $componentCriteria)
    {
        $this->weight = $weight;
        $this->componentCriteria = $componentCriteria;
    }

    /**
     * @return mixed
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param mixed $weight
     */
    public function setWeight($weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return mixed
     */
    public function getComponentCriteria()
    {
        return $this->componentCriteria;
    }

    /**
     * @param mixed $componentCriteria
     */
    public function setComponentCriteria($componentCriteria): void
    {
        $this->componentCriteria = $componentCriteria;
    }


}