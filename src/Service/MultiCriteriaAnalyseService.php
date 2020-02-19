<?php

namespace App\Service;

use App\Entity\Component;
use App\Entity\ComponentCriteria;
use App\Entity\Criteria;
use App\Entity\Type;
use App\Form\CriteriaType;
use App\Model\WeightCollectionModel;
use App\Model\WeightModel;
use App\Repository\ComponentCriteriaRepository;
use App\Repository\ComponentRepository;
use App\Repository\CriteriaRepository;
use App\Repository\TypeRepository;
use App\Repository\CriteriaTypeRepository;

class MultiCriteriaAnalyseService {

    /**
     * @var ComponentRepository
     */
    private $componentRepository;
    /**
     * @var TypeRepository
     */
    private $typeRepository;

    /**
     * @var CriteriaRepository
     */
    private $criteriaRepository;

    /**
     * @var $componentCriteria
     */
    private $componentCriteriaRepository;

    /**
     * @var $criteriaTypeRepository
     */
    private $criteriaTypeRepository;

    /**
     * MultiCriteriaAnalyseService constructor.
     * @param $componentRepository
     * @param $typeRepository
     */
    public function __construct(ComponentRepository $componentRepository, TypeRepository $typeRepository, CriteriaRepository $criteriaRepository,
                                ComponentCriteriaRepository $componentCriteriaRepository, CriteriaTypeRepository $criteriaTypeRepository)
    {
        $this->componentRepository = $componentRepository;
        $this->typeRepository = $typeRepository;
        $this->criteriaRepository = $criteriaRepository;
        $this->componentCriteriaRepository = $componentCriteriaRepository;
        $this->criteriaTypeRepository = $criteriaTypeRepository;
    }


    public function calculCriteria(WeightCollectionModel $weigthModels)
    {
//        //etape 1
//        //etape 2
//        //etape 3

        $criteriaTypes = $this->criteriaTypeRepository->findAll();

        $i = 0;
        $weigthModelsCollection = new WeightCollectionModel();
        $array = array();
        /** @var $criteriaTypes CriteriaType*/
        foreach ($criteriaTypes as $criteria){
            $array[$i] = new WeightModel($i, $criteria);
            $i++;
        }

        $weigthModelsCollection->setWeightModels($array);

        $this->calculBaseCriteria($weigthModelsCollection);
//        //etape 4
//        //etape 5
//        //etape 6
    }

    public function getAllTypes() {
        return $this->typeRepository->findAll();
    }

    public function calculBaseCriteria(WeightCollectionModel $weigthModelsCollection){

        $types = $this->getAllTypes();
        $res = [];
        /** @var $type Type */
        foreach ($types as $type){
            $criterias = $this->criteriaRepository->findByType($type);
            /** @var $criteria Criteria*/
            foreach($criterias as $criteria){
                $sommeCritType = $this->sommeCritere($criteria, $type);
                $weight = 0;
                /** @var $weigthModelsCollection WeightCollectionModel*/
                /** @var $weigthModel WeightModel*/
                foreach ($weigthModelsCollection->getWeightModels() as $weigthModel){
                    if($weigthModel->isGoodCriteriaType($criteria, $type)){
                        $weight = $weigthModel->getWeight();
                    }
                }

                $components = $this->componentRepository->findBy(['type' => $type->getId()]);
                foreach ($components as $component){
                    //Retrouver bon weight from CriteriaType
                    $valCalcul = $this->calculValueNetComponent($criteria, $weight, $sommeCritType, $component);
                    //Stocker la valeur au bon endroit component-criteria => valueNORMALIZE
                    $componentCriterias = $this->componentCriteriaRepository->findBy(['component_id' => $component->getId(), 'criteria_id' => $criteria->getId()]) ;
                    $res[$componentCriterias[0]->getId()] = $valCalcul;
                    var_dump($componentCriterias[0]->getId());
                    var_dump($res[$componentCriterias[0]->getId()]);
                }
            }
        }
        var_dump($res);
        return $res;
    }

    public function calculValueNetComponent(Criteria $criteria, $weight, $somme, Component $component){
        //(pds * value) / Somme(values)
        $componentCriterias = $this->componentCriteriaRepository->findBy(['component_id' => $component->getId(), 'criteria_id' => $criteria->getId()]) ;
        $value = $componentCriterias[0]->getValue();
        $res = ($weight * $value)/$somme;
        return $res;
    }


    public function sommeCritere(Criteria $critere, Type $type){
        $components = $this->componentRepository->findBy(['type' => $type->getId()]);
        $somme = 0;
        foreach ($components as $component){
            $compCrits = $this->componentCriteriaRepository->findBy(['component_id' => $component->getId(), 'criteria_id' => $critere->getId()]);
            //Une seule ligne
            foreach ($compCrits as $compCrit){
                $somme += $compCrit->getValue();
            }
        }
        return $somme;
    }

}
