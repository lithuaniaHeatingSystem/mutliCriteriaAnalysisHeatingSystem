<?php

namespace App\Controller;

use App\Entity\Criteria;
use App\Entity\CriteriaType;
use App\Entity\Type;
use App\Model\WeightCollectionModel;
use App\Model\WeightModel;
use App\Repository\CriteriaTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\MultiCriteriaAnalyseService;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(MultiCriteriaAnalyseService $multiCriteriaAnalyseService)
    {

        $array = new WeightCollectionModel();
        $multiCriteriaAnalyseService->calculCriteria($array);

        return $this->render('home/index.html.twig', [
        ]);
    }
}
