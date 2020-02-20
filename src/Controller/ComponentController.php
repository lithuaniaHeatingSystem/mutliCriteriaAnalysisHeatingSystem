<?php

namespace App\Controller;

use App\Entity\Component;
use App\Entity\ComponentCriteria;
use App\Entity\Type;
use App\Form\ComponentFirstType;
use App\Form\ComponentSecondType;
use App\Repository\CriteriaRepository;
use App\Entity\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function PHPSTORM_META\type;

class ComponentController extends AbstractController
{

    /**
<<<<<<< HEAD
     * @Route("/component-list", name="component_list")
     */
    public function list()
    {
        //@TODO paginate with pager fanta
        return $this->render('component/list.html.twig', [
            'components' => $this->getDoctrine()->getRepository(Component::class)->findAll(),
        ]);
    }

    /**
     * @Route("/heating-list", name="heating_list")
     */

    public function listHeating()
    {
        $repo = $this->getDoctrine()->getRepository(Component::class);
        $components= $repo->findBy(array('type' => '11'));
        return $this->render('component/list.html.twig',[
        'components' =>$components
        ]);
    }

    /**
     * @Route("/pipe-list", name="pipe_list")
     */

    public function listPipe()
    {
        $repo = $this->getDoctrine()->getRepository(Component::class);
        $components= $repo->findBy(array('type' => '12'));
        return $this->render('component/list.html.twig',[
        'components' =>$components
        ]);
    }

    /**
     * @Route("/thermostaticvalve-list", name="thermostaticvalve_list")
     */

    public function listThermostaticValve()
    {
        $repo = $this->getDoctrine()->getRepository(Component::class);
        $components= $repo->findBy(array('type' => '13'));
        return $this->render('component/list.html.twig',[
        'components' =>$components
        ]);
    }

    
    /**
     * @Route("/valve-list", name="valve_list")
     */

    public function listValve()
    {
        $repo = $this->getDoctrine()->getRepository(Component::class);
        $components= $repo->findBy(array('type' => '14'));
        return $this->render('component/list.html.twig',[
        'components' =>$components
        ]);
    }

    /**
     * @Route("/circulationpump-list", name="circulationpump_list")
     */

    public function listCirculationPump()
    {
        $repo = $this->getDoctrine()->getRepository(Component::class);
        $components= $repo->findBy(array('type' => '15'));
        return $this->render('component/list.html.twig',[
        'components' =>$components
        ]);
    }

    /**
     * @Route("/component/{componentId}", name="create_or_update_component")
=======
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
>>>>>>> master
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
<<<<<<< HEAD
    public function delete(Component $component)
=======
    public function delete(Request $request, Component $component, Type $type)
>>>>>>> master
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($component);
        $em->flush();

<<<<<<< HEAD
        $repository = $this->getDoctrine()
                   ->getManager()
                   ->getRepository(Component::class);
        $typeheating = $repository->findOneBy(array('type' => '11'));
        $typepipe = $repository->findOneBy(array('type' => '12'));

        if($typeheating === '11') return $this->redirect($this->generateUrl('heating_list'));
        if($typepipe === '12') return $this->redirect($this->generateUrl('pipe_list'));
=======
        return $this->redirect($this->generateUrl('component_list', ['typeLabel' => $type->getLabel()]));
>>>>>>> master
    }

}
