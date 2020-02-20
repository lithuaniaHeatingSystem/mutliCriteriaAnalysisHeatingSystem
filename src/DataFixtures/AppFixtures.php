<?php

namespace App\DataFixtures;

use App\Entity\Criteria;
use App\Entity\CriteriaType;
use App\Entity\Type;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $heatingType = (new Type)->setLabel('radiator');
        $pipeType = (new Type)->setLabel('pipe');
        $thermostaticValveType = (new Type)->setLabel('thermostatic_valve');
        $valveType = (new Type)->setLabel('valve');
        $circulationPumpType = (new Type)->setLabel('circulation_pump');

        $manager->persist($heatingType);
        $manager->persist($pipeType);
        $manager->persist($thermostaticValveType);
        $manager->persist($valveType);
        $manager->persist($circulationPumpType);
        $manager->flush();


        $priceCriteria = (new Criteria)->setLabel("Price")->setDescription("Price")->setUnit("€");
        $priceCriteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(false));
        $priceCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(false));
        $priceCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(false));
        $priceCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(false));
        $manager->persist($priceCriteria);
        $manager->flush();

        $priceEuroMCriteria = (new Criteria)->setLabel("Price")->setDescription("Price")->setUnit("€/m");
        $priceEuroMCriteria->addCriteriaType((new CriteriaType())->setType($pipeType)->setIsPositive(false));
        $manager->persist($priceEuroMCriteria);
        $manager->flush();

        $thermalTransmissionCriteria = (new Criteria)->setLabel("Thermal transmission")->setDescription("Thermal transmission")->setUnit("W/m2K");
        $thermalTransmissionCriteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(true));
        $manager->persist($thermalTransmissionCriteria);
        $manager->flush();

        $sizeM2Criteria = (new Criteria)->setLabel("Size")->setDescription("Size")->setUnit("m2");
        $sizeM2Criteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(false));
        $manager->persist($sizeM2Criteria);
        $manager->flush();

        $weightCriteria = (new Criteria)->setLabel("Weight")->setDescription("Weight")->setUnit("kg");
        $weightCriteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(false));
        $manager->persist($weightCriteria);
        $manager->flush();

        $maxPressureCriteria = (new Criteria)->setLabel("Max pressure")->setDescription("Max pressure")->setUnit("bar");
        $maxPressureCriteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(true));
        $maxPressureCriteria->addCriteriaType((new CriteriaType())->setType($pipeType)->setIsPositive(true));
        $maxPressureCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $maxPressureCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $maxPressureCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(true));
        $manager->persist($maxPressureCriteria);
        $manager->flush();

        $maxTemperatureCriteria = (new Criteria)->setLabel("Max temperature")->setDescription("Max temperature")->setUnit("°c");
        $maxTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(true));
        $maxTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($pipeType)->setIsPositive(true));
        $maxTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $maxTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $maxTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(true));
        $manager->persist($maxTemperatureCriteria);
        $manager->flush();

        $minTemperatureCriteria = (new Criteria)->setLabel("Min temperature")->setDescription("Min temperature")->setUnit("°c");
        $minTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $minTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $minTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(true));
        $manager->persist($minTemperatureCriteria);
        $manager->flush();
    }
}
