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
        // dd($cardData);
        return $this->render('tchad_card/index.html.twig', [
            'myCards' => $cardData,
        ]);
    }

   
}
