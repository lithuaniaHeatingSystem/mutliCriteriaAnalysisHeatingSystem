<?php

namespace App\Controller;

use App\Entity\Component;
use App\Entity\ComponentCriteria;
use App\Entity\Type;
use App\Form\ComponentFirstType;
use App\Form\ComponentSecondType;
use App\Repository\CriteriaRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComponentController extends AbstractController
{

    /**
     * @Route("/component-list/{typeLabel}", name="component_list")
     *
     * @ParamConverter("type", options={"mapping": {"typeLabel": "label"}})
     *
     * @param Type $type
     *
     * @return Response
     */
    public function listComponent(Type $type)
    {
        $components = $this->getDoctrine()->getRepository(Component::class)->findBy(['type' => $type]);

        return $this->render('component/list.html.twig',
            ['components' => $components, 'typeLabel' => $type->getLabel()]);
    }

    /**
     * @Route("/component/{typeLabel}/{componentId}", name="create_or_update_component")
     *
     * @ParamConverter("type", options={"mapping": {"typeLabel": "label"}})
     *
     * @param Request  $request
     * @param int|null $componentId
     *
     * @param Type     $type
     *
     * @return Response
     */
    public function createOrUpdateComponent(Request $request, Type $type, ?int $componentId = null)
    {
        $component = null;
        if ($componentId !== null) {
            $component = $this->getDoctrine()->getRepository(Component::class)->find($componentId);
        }
        if ($component === null && $componentId !== null) {
            return $this->redirect($this->generateUrl('create_or_update_component', ['componentId' => null]));
        } elseif ($componentId === null && $component === null) {
            $component = (new Component())->setType($type);
        }

        $form = $this->createForm(ComponentFirstType::class, $component, ['validation_groups' => ['first_step']]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $component = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($component);
            $em->flush();

            return $this->redirect($this->generateUrl('create_or_update_component_criteria',
                ['componentId' => $component->getId(), 'typeLabel' => $type->getLabel()]));
        }


        return $this->render('component/first_step.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/component-criteria/{typeLabel}/{componentId}", name="create_or_update_component_criteria")
     *
     * @ParamConverter("component", options={"id" = "componentId"})
     * @ParamConverter("type", options={"mapping": {"typeLabel": "label"}})
     *
     * @param Request            $request
     * @param Component          $component
     * @param CriteriaRepository $criteriaRepository
     *
     * @param Type               $type
     *
     * @return Response
     */
    public function createOrUpdateComponentCriteria(Request $request,
        Component $component,
        CriteriaRepository $criteriaRepository,
        Type $type
    )
    {
        $type = $component->getType();
        $criterias = $criteriaRepository->findByType($type);

        // pre set collection
        if (count($component->getComponentCriterias()) === 0) {
            // new component doesn't content criteria
            foreach ($criterias as $criteria) {
                $component->addComponentCriteria((new ComponentCriteria())->setComponent($component)->setCriteria($criteria));
            }
        } else {
            // component already have criteria updated it if new
            $oldCriterias = $component->getCriterias();
            foreach ($criterias as $criteria) {
                if (!$oldCriterias->contains($criteria)) {
                    $component->addComponentCriteria((new ComponentCriteria())->setComponent($component)->setCriteria($criteria));
                }
            }
        }

        $form = $this->createFormBuilder($component, ['validation_groups' => ['second_step']])
            ->add('componentCriterias', CollectionType::class, [
                'entry_type' => ComponentSecondType::class,
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $component = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($component);
            $em->flush();

            return $this->redirect($this->generateUrl('component_list', ['typeLabel' => $type->getLabel()]));
        }


        return $this->render('component/second_step.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/component-delete/{typeLabel}/{componentId}", name="component_delete")
     *
     * @ParamConverter("component", options={"mapping": {"componentId": "id"}})
     * @ParamConverter("type", options={"mapping": {"typeLabel": "label"}})
     *
     * @param Request   $request
     * @param Component $component
     * @param Type      $type
     *
     * @return Response
     */
    public function delete(Request $request, Component $component, Type $type)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($component);
        $em->flush();

        return $this->redirect($this->generateUrl('component_list', ['typeLabel' => $type->getLabel()]));
    }
}
