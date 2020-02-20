<?php

namespace App\DataFixtures;

use App\Entity\Component;
use App\Entity\ComponentCriteria;
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

        $reliabilityCriteria = (new Criteria)->setLabel("Reliability")->setDescription("Reliability")->setUnit("Cycles");
        $reliabilityCriteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(true));
        $manager->persist($reliabilityCriteria);
        $manager->flush();

        $sizeM2Criteria = (new Criteria)->setLabel("Size")->setDescription("Size")->setUnit("m2");
        $sizeM2Criteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(false));
        $manager->persist($sizeM2Criteria);
        $manager->flush();

        $designCriteria = (new Criteria)->setLabel("Design")->setDescription("Design")->setUnit("%");
        $designCriteria->addCriteriaType((new CriteriaType())->setType($heatingType)->setIsPositive(true));
        $designCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $manager->persist($designCriteria);
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

        $powerCriteria = (new Criteria)->setLabel("Power")->setDescription("Power")->setUnit("W");
        $powerCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(false));
        $manager->persist($powerCriteria);
        $manager->flush();

        $pressureCriteria = (new Criteria)->setLabel("Pressure")->setDescription("Pressure")->setUnit("m3/h");
        $pressureCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(true));
        $manager->persist($pressureCriteria);
        $manager->flush();

        $energyCriteria = (new Criteria)->setLabel("Energy consumption")->setDescription("Energy consumption")->setUnit("W");
        $energyCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(false));
        $manager->persist($energyCriteria);
        $manager->flush();

        $variationTempCriteria = (new Criteria)->setLabel("Temperature variation")->setDescription("Temperature variation")->setUnit("°C");
        $variationTempCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(true));
        $manager->persist($variationTempCriteria);
        $manager->flush();

        $minTemperatureCriteria = (new Criteria)->setLabel("Min temperature")->setDescription("Min temperature")->setUnit("°c");
        $minTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $minTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $minTemperatureCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(true));
        $manager->persist($minTemperatureCriteria);
        $manager->flush();

        $minCcCriteria = (new Criteria)->setLabel("Min/cc turn")->setDescription("Min/cc turn")->setUnit("Tm / cc");
        $minCcCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(true));
        $manager->persist($minCcCriteria);
        $manager->flush();

        $intensityCriteria = (new Criteria)->setLabel("Intensity")->setDescription("Intensity")->setUnit("A");
        $intensityCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(false));
        $manager->persist($intensityCriteria);
        $manager->flush();

        $voltageCriteria = (new Criteria)->setLabel("Voltage")->setDescription("Voltage")->setUnit("V");
        $voltageCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(false));
        $manager->persist($voltageCriteria);
        $manager->flush();

        $diametreRaccordCriteria = (new Criteria)->setLabel("Diametre raccord")->setDescription("Diametre raccord")->setUnit("Pouce");
        $diametreRaccordCriteria->addCriteriaType((new CriteriaType())->setType($circulationPumpType)->setIsPositive(false));
        $manager->persist($diametreRaccordCriteria);
        $manager->flush();

        $heatLossCriteria = (new Criteria)->setLabel("Heat loss coefficient")->setDescription("Heart loss coefficient")->setUnit("%");
        $heatLossCriteria->addCriteriaType((new CriteriaType())->setType($pipeType)->setIsPositive(false));
        $manager->persist($heatLossCriteria);
        $manager->flush();

        $longevityCriteria = (new Criteria)->setLabel("Life time")->setDescription("Life time")->setUnit("years");
        $longevityCriteria->addCriteriaType((new CriteriaType())->setType($pipeType)->setIsPositive(true));
        $manager->persist($longevityCriteria);
        $manager->flush();

        $pressureResistanceCriteria = (new Criteria)->setLabel("Pressure resistance")->setDescription("Pressure resistance")->setUnit("kPa");
        $pressureResistanceCriteria->addCriteriaType((new CriteriaType())->setType($pipeType)->setIsPositive(true));
        $manager->persist($longevityCriteria);
        $manager->flush();

        $lenghCriteria = (new Criteria)->setLabel("Length")->setDescription("Length")->setUnit("m");
        $lenghCriteria->addCriteriaType((new CriteriaType())->setType($pipeType)->setIsPositive(true));
        $manager->persist($lenghCriteria);
        $manager->flush();

        $minPressureRangeCriteria = (new Criteria)->setLabel("Min pressure range")->setDescription("Min pressure range")->setUnit("Kpa");
        $minPressureRangeCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(false));
        $manager->persist($minPressureRangeCriteria);
        $manager->flush();

        $maxPressureRangeCriteria = (new Criteria)->setLabel("Max pressure range")->setDescription("Max pressure range")->setUnit("Kpa");
        $maxPressureRangeCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $manager->persist($maxPressureRangeCriteria);
        $manager->flush();

        $maxPressureCriteria = (new Criteria)->setLabel("Max pressure")->setDescription("Max pressure")->setUnit("Bar");
        $maxPressureCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $maxPressureCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $manager->persist($maxPressureCriteria);
        $manager->flush();

        $kvsCriteria = (new Criteria)->setLabel("Kvs")->setDescription("Kvs")->setUnit("m3/h");
        $kvsCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $manager->persist($kvsCriteria);
        $manager->flush();

        $qmaxCriteria = (new Criteria)->setLabel("Qmax")->setDescription("Qmax")->setUnit("m3/h");
        $qmaxCriteria->addCriteriaType((new CriteriaType())->setType($valveType)->setIsPositive(true));
        $manager->persist($qmaxCriteria);
        $manager->flush();

        $waterFlowCriteria = (new Criteria)->setLabel("Water flow")->setDescription("Water flow")->setUnit("m3/h");
        $waterFlowCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $manager->persist($waterFlowCriteria);
        $manager->flush();

        $deltaPCriteria = (new Criteria)->setLabel("Delta P. max")->setDescription("Delta P. max")->setUnit("kPa");
        $deltaPCriteria->addCriteriaType((new CriteriaType())->setType($thermostaticValveType)->setIsPositive(true));
        $manager->persist($deltaPCriteria);
        $manager->flush();



        $altimaVerticalHMComponent = (new Component)->setLabel("Altima Vertical HM-160-030")->setDescription("Smooth surface or worked in relief: ideal in housing (entry, living, room...) as in tertiary character")->setLink("https://acova.fr/radiateur-decoratif-chauffage-central/altima-vertical-38624")->setType($heatingType);
        //example
        //$altimaVerticalHMComponent->addComponentCriteria((new ComponentCriteria())->setValue(10)->setCriteria($designCriteria));
        $manager->persist($altimaVerticalHMComponent);
        $manager->flush();

        $karenaSvhComponent = (new Component)->setLabel("Karéna SVH-180-030")->setDescription("A modern design signed King & Miranda which will sublimate your interior. A clean line for a lighter profile")->setLink("https://acova.fr/radiateur-decoratif-chauffage-central/karana-38361")->setType($heatingType);
        $manager->persist($karenaSvhComponent);
        $manager->flush();

        $decoformComponent = (new Component)->setLabel("Decoform FWF-013-100")->setDescription("Retro industrial design with fins. Ideal radiator for bay windows")->setLink("https://acova.fr/radiateur-decoratif-chauffage-central/decoform-155577")->setType($heatingType);
        $manager->persist($decoformComponent);
        $manager->flush();

        $kadraneKaComponent = (new Component)->setLabel("Kadrane KA-097-040")->setDescription("A square line perfectly suited to contemporary interiors. Ideal in Claustra. A technoline finish option that will give a modern touch to your room")->setLink("https://acova.fr/radiateur-decoratif-chauffage-central/kadrabe-38366")->setType($heatingType);
        $manager->persist($kadraneKaComponent);
        $manager->flush();

        $altaiVerticalComponent = (new Component)->setLabel("Altai Vertical HYD-200-026")->setDescription("A very modern and graphic refined design, linked to the narrowness of its flat tubes. Extra-flat, Altai offers a very low projection on the wall, even on double models")->setLink("https://acova.fr/radiateur-decoratif-chauffage-central/altai-vertical-38285")->setType($heatingType);
        $manager->persist($altaiVerticalComponent);
        $manager->flush();



        $grundfosComponent = (new Component)->setLabel("Grundfos")->setDescription("Flooded rotor type circulator for circulation of hot or cold water for heating, cold and air conditioning or DHW systems. Circulator body in corrosion-resistant stainless steel or bronze")->setLink("https://www.batiproduits.com/fiche/produits/circulateur-pour-eau-chaude-ou-froide-p68930683.html")->setType($circulationPumpType);
        $manager->persist($grundfosComponent);
        $manager->flush();

        $vsComponent = (new Component)->setLabel("VS 65/150")->setDescription("Bronze body. Aluminium motor housing. Technopolymer turbine. Ceramic motor shaft mounted on graphite bearings lubricated by the pumped liquid")->setLink("https://www.pompes-direct.com/upload/pdfDescriptif_45637.pdf")->setType($circulationPumpType);
        $manager->persist($vsComponent);
        $manager->flush();

        $calioComponent = (new Component)->setLabel("Calio S")->setDescription("Maintenance-free, energy-efficient flooded rotor circulator with threaded ports, with high-efficiency electric motor and continuous differential pressure regulation")->setLink("https://produts.ksb.com/fr-fr/produits/pompes-et-systemes-de-pompage/pompes-de-chauffage/calio-s-78910")->setType($circulationPumpType);
        $manager->persist($calioComponent);
        $manager->flush();

        $grundfosAlphaComponent = (new Component)->setLabel("Grundfos Alpha")->setDescription("Variable speed circulator with energy efficiency. AutoAdapt function, it is suitable for more installations, integrated differential pressure control")->setLink("https://www.manomano.fr/p/grundfos-circulateur-alpha-2-25-60-entraxe-180-97993201-102626?model_id=102797")->setType($circulationPumpType);
        $manager->persist($grundfosAlphaComponent);
        $manager->flush();

        $wiloStarRsComponent = (new Component)->setLabel("Wilo-Star-Rs")->setDescription("Grandless circulation pump with threaded connection. Pre-selectable speed stages for power ajustement. Hot-water heating systems of all kinds, industrial circulation systems, cold water systems and air-conditioning systems")->setLink("https://www.termosistem.com.mk/wp-content/uploads/2014/01/Star-RS-Catalogue.pdf")->setType($circulationPumpType);
        $manager->persist($wiloStarRsComponent);
        $manager->flush();



        
        $copperTubeComponent = (new Component)->setLabel("Copper tube")->setDescription("Nf-EN 1057 copper tube for sanitary use, 30 year anti-corrosion guarantee. For any installation of sanitary water, heating or gas. Thickness 1mm. 1/2 Hard (R250). Certificate of conformity NF EN 1057")->setLink("https://www.anjou-connectique.com/tube-cuivre-nu-ecrou-12mm-en-barre.html")->setType($pipeType);
        $manager->persist($copperTubeComponent);
        $manager->flush();
    
        $multilayerPipeComponent = (new Component)->setLabel("Multilayer pipe")->setDescription("Welded edge to edge, the O.2 mm to 0.5 mm thick aluminium tube guarantees high durability, excellent sealing and non-deformability of the tube. Reinforced adhesion for perfect cohesion between HDPE / PE-RT and aluminium")->setLink("https://www.anjou-connectique.com/200m-tube-multicouche-nu-16x2-somatherm.html")->setType($pipeType);
        $manager->persist($multilayerPipeComponent);
        $manager->flush();
    
        $blueMultilayertubeComponent = (new Component)->setLabel("Blue pre-sheathed multilayer tube")->setDescription("Aluminium tube butt welded lenghthwisse. 100% oxygen tight. Low coefficient of linear expansion, like metal. Fully resistant to corrosion, as well as chemical and electrochemical influences")->setLink("https://www.anjou-connectique.com/10m-multicouche-pregaine-bleue-pe-xc-al-pe-xc-aluminium-4mm-o20x2-0.html")->setType($pipeType);
        $manager->persist($blueMultilayertubeComponent);
        $manager->flush();
    
        $preSheatedComponent = (new Component)->setLabel("Pre-sheated PER tube")->setDescription("External protection of the PER tube is ensured by a sheath which will prevent damage to the tube and which may allow the tube to be replaced if necessary. Ensuring better resistance to pressure and high temperatures")->setLink("https://www.anjou-connectique.com/100m-tube-per-pre-gaine-bleue-diametre-12-blansol-barbi.html")->setType($pipeType);
        $manager->persist($preSheatedComponent);
        $manager->flush();
    
        $pvcLisseComponent = (new Component)->setLabel("PVC lisse")->setDescription("Diameter 32mm. Quality mark NFE + NF-Me = ERP security. Smooth wall for maximum hydraulic quality. Fire safety: NFMe certification obeying French fire safety regulations in public buildings. Bonding assembly according to NF in 1453")->setLink("https://www.anjou-connectique.com/tube-pvc-evacuation-nf-me-lisse-diametre-32-mm.html")->setType($pipeType);
        $manager->persist($pvcLisseComponent);
        $manager->flush();

        $flatHeatPipeComponent = (new Component)->setLabel("Flat heat pipe")->setDescription("ATS' high performance Flat Heat Pipes are used to tranfer heat with minimal temperature difference or spread the heat accross a surface. ATS' heat pipes are low profile and can easily attach to a heat sink")->setLink("https://www.qats.com/Products/Heat-Pipes/Flat-Heat-Pipes/ATS-HP-F7L100S70W-016")->setType($pipeType);
        $manager->persist($flatHeatPipeComponent);
        $manager->flush();



        $kitstapComponent = (new Component)->setLabel("Kitstap")->setDescription("The STAP differential pressure regulator coupled to the RPDTAV valve allows precise adjustement of the flow while maintening a constant pressure difference")->setLink("https://www.cgr-robinetterie.fr/produits/Robinetterie/KIT-DE-REGULATION/p/KITSTAP15")->setType($valveType);
        $manager->persist($kitstapComponent);
        $manager->flush();
        
        $asvpvComponent = (new Component)->setLabel("ASV-PV")->setDescription("The ASV series automatic balancing valves are pressure differential constancy regulators designed for hydraulic balancing of heat and cold supply systems for piping at variable flow rates of the fluid passing through them within a range of 0 to 100%")->setLink("https://wtpump.ru/catalog/detail/60029/")->setType($valveType);
        $manager->persist($asvpvComponent);
        $manager->flush();
        
        $caleffiDnComponent = (new Component)->setLabel("Caleffi dn")->setDescription("The differential pressure regulator maintains the pressure difference between two points in a hydraulic circuit at a predefined value. The balancing valve balances the flow of the heat transfer fluid on the circuit where it is mounted")->setLink("https://www.thersane.fr/regulateurs-de-pression-differentielle/311-regulateur-pression-differentielle-laiton-femelle.html#/417-diametre_dn_et_pression_differentielle_admissible_mbar-dn_3_4_et_250_600mbar")->setType($valveType);
        $manager->persist($caleffiDnComponent);
        $manager->flush();

        $comapComponent = (new Component)->setLabel("Comap DPCV")->setDescription("The Broen Ballorex DP differential pressure regulator is designed to be installed on return lines. The device in automatic mode supports the necessary pressure drops, prevents noise and acts as a drain valve and stop valve")->setLink("http//www.buildeng.ru/catalog/regulyatory_perepeda_davleniya/broen_regulyatory_perepada_davleniya/regulyator_perepada_davleniya_broen_dp_s_impulsnoy_trubkoy_i_drenazhnym_kranom/2671/")->setType($valveType);
        $manager->persist($comapComponent);
        $manager->flush();


        $contractAngledComponent = (new Component)->setLabel("Contract angled TRV & lockshield")->setDescription("Liquid sensor. Vertical or horizontal head, bi-directional body. Max working pressure 10 bar. Max flow 120 °C. Range 6°-28°C frost protection")->setLink("https://www.toolstation.com/contact-angled-trv-lockshield/p12821")->setType($thermostaticValveType);
        $manager->persist($contractAngledComponent);
        $manager->flush();

        $flexoDesignComponent = (new Component)->setLabel("FlexoDesign thermostatic valve")->setDescription("The FlexoDesign central connection thermostatic valve set is a practical solution to install and ideal for bringing a touch of design to the towel radiator")->setLink("https://www.comap.be/fr/catalogue/robinetterie-chauffage-comap/robinet-thermostatique-flexodesign")->setType($thermostaticValveType);
        $manager->persist($flexoDesignComponent);
        $manager->flush();
            
        $mutTmComponent = (new Component)->setLabel("Mut tm")->setDescription("TM 3000 mixer valves find application in those heating systems where it is essential to ensure the return of hot water to the boiler. Thus ensuring a sufficiently high thermal regime of operation to prevent vapour condensation in the smokestack")->setLink("http://www.mutmeccania.com/prodottomutmeccania.php?p=177")->setType($thermostaticValveType);
        $manager->persist($mutTmComponent);
        $manager->flush();
            
        $rvoComponent = (new Component)->setLabel("RVO")->setDescription("This manually operated valve designed for radiators and towel dryers is suitable for use both in heating and tap water systems. Gunmetal construction enhaces durability, while double O-rings reduce risk of leakage")->setLink("https://www.imi-hydronic.com/sites/EN/international/products/thermostatic-control/thermostatic-heads-radiator-valves/manual-radiator-valves/RVO-1/29d1a180-54fd-44b1-b7b4-8b91f3b827c2")->setType($thermostaticValveType);
        $manager->persist($rvoComponent);
        $manager->flush();



    }
}
