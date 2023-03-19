<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    /**
     * @param Request $request
     * @param FruitRepository $fruitRepository
     * @return Response
     */
    #[Route('/api/fruits')]
    public function getAll(Request $request, FruitRepository $fruitRepository): Response
    {
        $page = (int)$request->query->get('page', 1);
        $offset = ($page - 1) * FruitRepository::PAGINATOR_PER_PAGE;
        $criteria = [];

        if ($name = $request->query->get('name')) {
            $criteria['name'] = $name;
        }

        if ($family = $request->query->get('family')) {
            $criteria['family'] = $family;
        }

        $total = $fruitRepository->count($criteria);
        return $this->json([
            'total' => $total,
            'items' => $fruitRepository->getList($offset, $criteria),
            'pages' => ceil($total / FruitRepository::PAGINATOR_PER_PAGE),
        ]);
    }

    /**
     * @param string $list
     * @param FruitRepository $fruitRepository
     * @return Response
     */
    #[Route('/api/fruits/{list<name|family>}')]
    public function getName(string $list, FruitRepository $fruitRepository): Response
    {
        $items = [];
        foreach ($fruitRepository->listOf($list) as $row) {
            $items[] = $row[$list];
        }

        return $this->json([
            'items' => $items,
        ]);
    }
}
