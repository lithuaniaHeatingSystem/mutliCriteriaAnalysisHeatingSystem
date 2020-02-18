<?php

namespace App\Controller;

use App\Entity\Component;
use App\Form\ComponentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComponentController extends AbstractController
{
    /**
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
     * @Route("/component-add", name="component_add")
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request)
    {
        $form = $this->createForm(ComponentType::class, new Component);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $component = $form->getData();
            $em->persist($component);
            $em->flush();

            return $this->redirect($this->generateUrl('component_list'));
        }

        return $this->render('component/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/component-edit/{id}", name="component_edit")
     * @ParamConverter("component", class="App\Entity\Component")
     *
     * @param Request  $request
     *
     * @param Component $component
     *
     * @return Response
     */
    public function edit(Request $request, Component $component)
    {
        $form = $this->createForm(ComponentType::class, $component);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $criteria = $form->getData();
            $em->persist($criteria);
            $em->flush();

            return $this->redirect($this->generateUrl('component_list'));
        }

        return $this->render('component/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/component-delete/{id}", name="component_delete")
     * @ParamConverter("component", class="App\Entity\Component")
     *
     * @param Request  $request
     *
     * @param Component $component
     *
     * @return Response
     */
    public function delete(Request $request, Component $component)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($component);
        $em->flush();

        return $this->redirect($this->generateUrl('component_list'));
    }
}
