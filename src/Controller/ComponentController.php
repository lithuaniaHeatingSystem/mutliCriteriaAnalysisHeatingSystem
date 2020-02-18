<?php

namespace App\Controller;

use App\Entity\Component;
use App\Form\ComponentType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ComponentController extends AbstractController
{
    /**
     * @Route("/component", name="component")
     */
    public function index()
    {
        return $this->render('component/index.html.twig', [
            'controller_name' => 'ComponentController',
        ]);
    }


    /**
     * @Route("/component-add", name="component_add")
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function add(Request $request)
    {
        $form = $this->createForm(ComponentType::class, new Component(), ['validation_groups' => ['first_step']]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $component = $form->getData();
            $em = $this->getDoctrine()->getManager();

            $em->persist($component);
            $em->flush();

            //@TODO redirect to next step
        }


        return $this->render('component/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
