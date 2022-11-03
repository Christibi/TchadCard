<?php

namespace App\Controller;

use App\Repository\TchadCardTableRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            'myCards' => $cardData,
            'cardData' => json_encode($cardData),
            'donnees' => json_encode($donnees),
        ]);
    }

   
}
