<?php

namespace App\Service;

use App\Entity\Component;
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
        $res = array();

        $res = $this->calculBaseCriteria($weigthModels);
        $res = $this->finalCalcul($res);
//        //etape 4
//        //etape 5
//        //etape 6
        return $res;
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
                $arrayValue = array();
                foreach ($components as $component){
                    if (!(array_key_exists($component->getId(), $res))){
                        $res[$component->getId()] = array();
                    }
                    //Retrouver bon weight from CriteriaType
                    $valCalcul = $this->calculValueNetComponent($criteria, $weight, $sommeCritType, $component);
                    //Stocker la valeur au bon endroit component-criteria => valueNORMALIZE
                    $criteriaTypes = $this->criteriaTypeRepository->findBy(['type' => $type->getId(), 'criteria' => $criteria->getId()]);
                    $arrayValue= array($criteriaTypes[0]->getId() => $valCalcul);
                    //$res[$component->getId()] = [$criteriaTypes[0]->getId() => $valCalcul];
                }
            }
        }
        return $res;
    }

    public function calculValueNetComponent(Criteria $criteria, $weight, $somme, Component $component){
        //(pds * value) / Somme(values)
        $componentCriterias = $this->componentCriteriaRepository->findBy(['component' => $component, 'criteria' => $criteria]) ;
        $value = $componentCriterias[0]->getValue();
        $res = ($weight * $value)/$somme;
        return $res;
    }


    public function finalCalcul(Array $componentsTypeValue){
        $arrayPos = array();
        $arrayNeg = array();
        $sommeArrayNeg = array();
        $res = array();


        foreach ($componentsTypeValue as $composant => $value){
            $arrayPos[$composant] = 0.0;
            $arrayNeg[$composant] = 0.0;
            $sommeArrayNeg[$this->componentRepository->findBy(['id' => $composant])[0]->getType()->getId()] = 0.0;
            foreach($value as $value2){
                foreach ($value2 as $crit => $valeurNet){
                    $criteres = $this->criteriaTypeRepository->findBy(['id' => $crit]);
                    $signe = null;
                    foreach ($criteres as $critere){
                        $signe = $critere->getIsPositive();

                    }
                    if ($signe){
                        //Tableau des +
                        $arrayPos[$composant] += $valeurNet;

                    } else {
                        //Tableau des -
                        $arrayNeg[$composant] += $valeurNet;
                        $types = $this->componentRepository->findBy(['id' => $composant])[0]->getType()->getId();
                        /** @var $type Type */
                        foreach ($types as $type){
                            $sommeArrayNeg[$type->getId()] += $valeurNet;

                        }
                    }
                }
            }
        }

        /** @var $component Component */
        foreach ($this->componentRepository->findAll() as $component){
            $sommePlus = $arrayPos[$component->getId()];
            $sommeMoins = $arrayNeg[$component->getId()];

            $comp = $this->componentRepository->findBy(['id' => $component]);
            var_dump($comp[0]->getType());
            $inverseSommeMoins = 1 / $sommeArrayNeg[$comp[0]->getType()];

            $calcul = $sommePlus + ($sommeArrayNeg[$comp[0]->getType()] / ($sommeMoins * $inverseSommeMoins));
            $array[$component->getId()] = $calcul;
            array_push($res[$component->getType()], $array[$component->getId()]);
        }

        foreach($res as $typeId => $components){
            //var_dump($components);
            arsort($components);
            //var_dump($components);
        }
        return $res;
    }

    public function sommeCritere(Criteria $critere, Type $type){
        $components = $this->componentRepository->findBy(['type' => $type]);
        $somme = 0;
        foreach ($components as $component){
            $compCrits = $this->componentCriteriaRepository->findBy(['component' => $component, 'criteria' => $critere]);
            //Une seule ligne
            foreach ($compCrits as $compCrit){
                $somme += $compCrit->getValue();
            }
        }
        return $somme;
    }

}
