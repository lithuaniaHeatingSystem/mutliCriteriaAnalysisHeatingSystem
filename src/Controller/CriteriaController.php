<?php

namespace App\Controller;

use App\Entity\Criteria;
use App\Entity\Type;
use App\Form\CriteriaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CriteriaController extends AbstractController
{
    /**
     * @Route("/criteria-list", name="criteria_list")
     */
    public function list()
    {
        //@TODO paginate with pager fanta
        return $this->render('criteria/list.html.twig', [
            'criterias' => $this->getDoctrine()->getRepository(Criteria::class)->findAll(),
            'types' => $this->getDoctrine()->getRepository(Type::class)->findAll(),
        ]);
    }

    /**
     * @Route("/criteria/{criteriaId}", name="create_or_update_criteria")
     * @param Request $request
     *
     * @param int     $criteriaId
     *
     * @return Response
     */
    public function createOrUpdate(Request $request, int $criteriaId = null)
    {
        $criteria = null;
        if ($criteriaId !== null) {
            $criteria = $this->getDoctrine()->getRepository(Criteria::class)->find($criteriaId);
        }
        if ($criteria === null && $criteriaId !== null) {
            return $this->redirect($this->generateUrl('create_or_update_criteria', ['criteriaId' => null]));
        } elseif ($criteriaId === null && $criteria === null) {
            $criteria = new Criteria();
        }

        $types = $this->getDoctrine()->getRepository(Type::class)->findAll();

        // pre set collection
        if (count($criteria->getCriteriaTypes()) === 0) {
            // new criteria doesn't content type
            foreach ($types as $type) {
                $criteria->addCriteriaType((new \App\Entity\CriteriaType())->setType($type));
            }
        } else {
            // component already have criteria updated it if new
            $oldTypes = $criteria->getTypes();

            foreach ($types as $type) {
                if (!$oldTypes->contains($type)) {
                    $criteria->addCriteriaType((new \App\Entity\CriteriaType())->setType($type));
                }
            }
        }

        $form = $this->createForm(CriteriaType::class, $criteria);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            /** @var Criteria $criteria */
            $criteria = $form->getData();
            // remove unchecked criteria type and keep checked
            foreach ($form[ 'criteriaTypes' ] as $criteriaType) {
                if (!$criteriaType[ 'isChecked' ]->getData()) {
                    $criteria->removeCriteriaType($criteriaType->getData());
                    if ($criteriaType->getData()->getId()) {
                        $em->remove($criteriaType->getData());
                    }
                }
            }

            $em->persist($criteria);
            $em->flush();

            return $this->redirect($this->generateUrl('criteria_list'));
        }

        return $this->render('criteria/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/criteria-delete/{id}", name="criteria_delete")
     * @ParamConverter("criteria", class="App\Entity\Criteria")
     *
     * @param Request  $request
     *
     * @param Criteria $criteria
     *
     * @return Response
     */
    public function delete(Request $request, Criteria $criteria)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($criteria);
        $em->flush();

        return $this->redirect($this->generateUrl('criteria_list'));
    }
}
