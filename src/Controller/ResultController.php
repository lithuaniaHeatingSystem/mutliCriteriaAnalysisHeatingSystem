<?php

namespace App\Controller;

use App\Entity\Component;
use App\Entity\Result;
use App\Entity\Type;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultController extends AbstractController
{

    /**
     * @Route("/result-list", name="result_list")
     *
     * @return Response
     */
    public function listResult()
    {
//        $types = $this->getDoctrine()->getRepository(Type::class)->findall();
//        $array = [];
//        foreach ($types as $type) {
//            if (count($array) === 0) {
//                $array = [$type->getId() => ['4', '5']];
//            }else{
//                $array += [$type->getId() => ['4']];
//            }
//        }
//
//            var_dump(serialize($array));
//            die;
        $results = $this->getDoctrine()->getRepository(Result::class)->findBy([], ['createdAt' => 'DESC']);

        return $this->render('result/list.html.twig',
            ['results' => $results]);
    }

    /**
     * @Route("/result/{resultId}", name="result_show")
     *
     * @ParamConverter("result", options={"mapping": {"resultId": "id"}})
     *
     * @param Result $result
     *
     * @return Response
     */
    public function showResult(Result $result)
    {
        $typeComponents = unserialize($result->getResult());
        $types = [];
        foreach ($typeComponents as $key => $values) {
            $type = $this->getDoctrine()->getRepository(Type::class)->find($key);
            count($types) === 0 ? $types = [$key => $type] : $types += [$key => $type];
            foreach ($typeComponents[ $key ] as $keyIdComponent => $componentId) {
                $typeComponents[ $key ][ $keyIdComponent ] = $this->getDoctrine()->getRepository(Component::class)->find($componentId);
            }
        }

        return $this->render('result/show.html.twig', [
            'typeComponents' => $typeComponents,
            'entityTypes' => $types,
            'result' => $result,
        ]);
    }
}
