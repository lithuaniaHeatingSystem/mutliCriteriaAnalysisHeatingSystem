<?php

namespace App\Controller;

use App\Entity\CriteriaType;
use App\Form\WeightCollectionType;
use App\Model\WeightCollectionModel;
use App\Model\WeightModel;
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

            $em = $this->getDoctrine()->getManager();
            $criteria = $form->getData();
            $em->persist($criteria);
            $em->flush();

            return $this->redirect($this->generateUrl('criteria_list'));
        }

        return $this->render('processing/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}