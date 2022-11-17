<?php

namespace App\Controller;

use App\Entity\Education;
use App\Form\EducationType;
use App\Form\ImportEducationFicheType;
use App\Repository\EducationRepository;
use App\Repository\IndicateurRepository;
use App\Repository\NiveauRepository;
use App\Repository\ProvincesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PhpOffice\PhpSpreadsheet\IOFactory;

class EducationController extends AbstractController
{
    #[Route('/education', name: 'app_education')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // RECUPERER DES DONNEES DANS LA BASE DE DONNEES
        $educationRepo = $doctrine->getRepository(Education::class);
        $education = $educationRepo->findAll();
        return $this->render('education/index.html.twig', [
            'MesEducations' => $education,
        ]);
    }

    #[Route('/importer', name: 'app_importer')]
    public function import(ManagerRegistry $doctrine, EducationRepository $educRepo, Request $request, NiveauRepository $niveauRepository, IndicateurRepository $indicateurRepository, ProvincesRepository $provincesRepository): Response
    {
        // creation du formulaire d'importation
        $form = $this->createForm(ImportEducationFicheType::class);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier = $form->get("fichier")->getData();
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::load($fichier);
            $tab = $reader->getActiveSheet()->toArray();
            $enregistrement = 0;
            for ($i = 1; $i < count($tab); $i++) {

                $indicateurExcel = $tab[$i][0];
                $provinceExcel = $tab[$i][1];
                $niveauExcel = $tab[$i][2];
                $Nbr_G_Excel = $tab[$i][3];
                $Nbr_F_Excel = $tab[$i][4];
                $AnneeExcel = $tab[$i][5];

                $indicateurBd = $indicateurRepository->findOneBy(["Libelle" => $indicateurExcel]);
                $provinceBd = $provincesRepository->findOneBy(["Libelle" => $provinceExcel]);
                $niveauBd = $niveauRepository->findOneBy(["Libelle" => $niveauExcel]);

                if ($tab[$i][0] != null) {
                    if ($niveauBd && $provinceBd && $indicateurBd) {
                        $education = new Education();
                        $education  ->setNiveau($niveauBd)
                                    ->setIndicateur($indicateurBd)
                                    ->setProvince($provinceBd)
                                    ->setNbreFe($tab[$i][4])
                                    ->setNbreH($tab[$i][3])
                                    ->setSource($fichier)
                                    ->setAnnee($AnneeExcel);
                        $em = $doctrine->getManager();
                        $em->persist($education);
                        $em->flush();
                    }
                }
            }
            // Afficharge de message de confirmation d'enregistrement
            $this->addFlash("success", "Importation finaliser");
            return $this->redirectToRoute("app_education");
        }else{
            return $this->render('education/importer.html.twig', [
                'formulaire' => $form->createView(),
            ]);
        }
        
    }


    #[Route('/education/editer/{id}', name: 'app_editer_education')]
    public function editerEducation($id, Request $request, ManagerRegistry $doctrine)
    {
        $educationRepo = $doctrine->getRepository(Education::class);
        $m = $educationRepo->find($id);

        $form = $this->createForm(EducationType::class, $m);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $m = $form->getData();
            // ENVOIS DANS LA BASE DE DONNEES
            $em = $doctrine->getManager();
            $em->persist($m);
            $em->flush();
            // Afficharge de message de confirmation d'enregistrement
            $this->addFlash("success", "Votre Education a été Modifier");

            // REDIRECTION DE LA PAGE
            return $this->redirectToRoute("app_education");
        }



        return $this->render("education/editer.html.twig", [
            "formulaire" => $form->createView()
        ]);
    }



    #[Route('/education/supprimer/{id}', name: 'app_supprimer_education')]
    public function supprimerEducation($id, ManagerRegistry $r, Request $request)
    {
        $educationRepo = $r->getRepository(Education::class);
        $education = $educationRepo->find($id);
        // condition de suppression

        if ($education) {
            $em = $r->getManager();
            $em->remove($education);
            $em->flush();
            // Afficharge de message de confirmation d'enregistrement
            $this->addFlash("success", "Education  supprimer");
        } else $this->addFlash("success", "Education inexistant");

        return $this->redirect($request->headers->get('referer'));
    }
}
