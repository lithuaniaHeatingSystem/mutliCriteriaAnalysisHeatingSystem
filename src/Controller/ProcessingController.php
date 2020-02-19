<?php

namespace App\Controller;

use App\Entity\CriteriaType;
use App\Entity\Type;
use App\Form\WeightCollectionType;
use App\Model\WeightCollectionModel;
use App\Model\WeightModel;
use App\Repository\TypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProcessingController extends AbstractController
{
    /**
     * @Route("/processing-form", name="processing_form")
     * @param Request $request
     *
     * @return Response
     */
    public function form(Request $request)
    {
        $CriteriaTypeRepository = $this->getDoctrine()->getRepository(CriteriaType::class);
        $criteriaTypes = $CriteriaTypeRepository->findAll();

        $types = $this->getDoctrine()->getRepository(Type::class)->findAll();


        $weightModels = new ArrayCollection();

        foreach ($criteriaTypes as $criteriaType) {
            $weightModel = new WeightModel();
            $weightModel->setCriteriaType($criteriaType);
            $weightModel->setWeight(0);
            $weightModels->add($weightModel);
        }


            $form = $this->createForm(WeightCollectionType::class,
                (new WeightCollectionModel())->setWeightModels($weightModels));

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $weightModels = $form->getData()->getWeightModels();

            /** @var WeightModel $data */
                foreach($types as $type){
                    var_dump($type.'    : ');
                    $totalWeight = 0;
                    foreach ($weightModels as $data){
                        if($data->getCriteriaType()->getType() ==  $type){
                            $totalWeight += $data->getWeight();
                        }
                    }
                    foreach ($weightModels  as $data){
                        if($data->getCriteriaType()->getType() ==  $type){
                            $data->setWeight($data->getWeight()/$totalWeight);
                        }
                    }
                }




                /** TODO call processing service **/

        }

        return $this->render('processing/form.html.twig', [
            'form' => $form->createView(),
            'types' => $types
        ]);
    }
}