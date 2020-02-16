<?php

namespace App\Controller;

use App\Entity\Criteria;
use App\Form\CriteriaType;
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
        ]);
    }

    /**
     * @Route("/criteria-add", name="criteria_add")
     * @param Request $request
     *
     * @return Response
     */
    public function add(Request $request)
    {
        $form = $this->createForm(CriteriaType::class, new Criteria);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $criteria = $form->getData();
            $em->persist($criteria);
            $em->flush();

           return $this->redirect($this->generateUrl('criteria_list'));
        }

        return $this->render('criteria/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
