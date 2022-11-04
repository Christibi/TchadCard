<?php

namespace App\Controller;

use App\Entity\TchadCardTable;
use App\Repository\TchadCardTableRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TchadCardController extends AbstractController
{
    #[Route('/', name: 'app_tchad_card')]
    public function index(ManagerRegistry $doctrine, TchadCardTableRepository $cardRepo): Response
    {
        $cardData = $cardRepo->findAll();
        $donnees=[];
        foreach ($cardData as $cardDatas) {
            $population= $cardDatas->getPopulations();
            $idRegion= $cardDatas->getIdRegion();
            $region= $cardDatas->getRegions();
            $threshold= $cardDatas->getThreshold();
            $donnees[] = [$idRegion, $region, $population, $threshold];

        }

        // dd($donnees[0][0]);
        return $this->render('tchad_card/index.html.twig', [
            // 'myCards' => $cardData,
            'cardData' => json_encode($cardData),
            'donnees' => json_encode($donnees),
        ]);
    }


    #[Route('/card', name: 'card.showAll', methods: 'GET')]
    public function showAll(ManagerRegistry $doctrine, TchadCardTableRepository $cardRepo): JsonResponse
    {
        $cardDatas = $cardRepo->findAll();

        if ($cardDatas) {
            $tabcardDatas = [];
            foreach ($cardDatas as $cardData) {
                $data = [
                    "id" => $cardData->getId(),
                    "idRegion" => $cardData->getIdRegion(),
                    "nomRegion" => $cardData->getRegions(),
                    "populations" => $cardData->getPopulations(),
                    "threshold" => $cardData->getThreshold()

                ];

                $tabcardDatas[] = $data;
            }
            $response = [
                "status" => "success",
                "message" => "Listes Des Regions",
                "Regions" => $tabcardDatas
            ];
        } else {
            $response = [
                "status" => "success",
                "message" => "La base données ne contient aucun donnes",
                "Regions" => 0
            ];
        }


        return $this->json($response);
    }

   
}
