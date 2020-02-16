<?php

namespace App\Controller;

use App\Entity\Criteria;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function add()
    {
        return $this->render('criteria/add.html.twig', [
        ]);
    }
}
