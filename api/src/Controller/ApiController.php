<?php

namespace App\Controller;

use App\Repository\FruitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ApiController extends AbstractController
{
    #[Route('/api/fruites')]
    public function getAll(Request $request, FruitRepository $fruitRepository): Response
    {
        $page = (int)$request->query->get('page', 1);
        $offset = ($page-1) * FruitRepository::PAGINATOR_PER_PAGE;
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

    #[Route('/api/fruites/name')]
    public function getName(FruitRepository $fruitRepository): Response
    {
        $items = [];
        foreach($fruitRepository->listOf('name') as $row){
            $items[] = $row['name'];
        }
        
        return $this->json([
            'items' => $items,
        ]);
    }

    #[Route('/api/fruites/family')]
    public function getFamily(FruitRepository $fruitRepository): Response
    {
        $items = [];
        foreach($fruitRepository->listOf('family') as $row){
            $items[] = $row['family'];
        }
        
        return $this->json([
            'items' => $items,
        ]);
    }
}