<?php

namespace App\Controller;

use App\Entity\ElementDonneeValeur;
use App\Form\ElementDonneValeurType;
use App\Form\ImportElementDonneeValeurFicheType;
use App\Repository\ElementDonneeRepository;
use App\Repository\ProvincesRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElementDonneeValeurController extends AbstractController
{
    #[Route('/element_donnee_valeur', name: 'app_element_donnee_valeur')]
    public function index(ManagerRegistry $doctrine): Response
    {
        // RECUPERER DES DONNEES DANS LA BASE DE DONNEES
        $valeurRepo = $doctrine->getRepository(ElementDonneeValeur::class);
        $valeur = $valeurRepo->findAll();
        return $this->render('element_donnee_valeur/index.html.twig', [
            'MesValeurs' => $valeur,
        ]);
    }

    #[Route('/importerValue', name: 'app_importer_value')]
    public function import(ManagerRegistry $doctrine, ElementDonneeRepository $elementDonneeRepo, Request $request, ProvincesRepository $provincesRepository): Response
    {
        // creation du formulaire d'importation
        $form = $this->createForm(ImportElementDonneeValeurFicheType::class);
        $form = $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $fichier = $form->get("fichier")->getData();
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::load($fichier);
            $tab = $reader->getActiveSheet()->toArray();
            $enregistrement = 0;
            for ($i = 1; $i < count($tab); $i++) {

                $elementDonneeExcel = $tab[$i][0];
                $provinceExcel = $tab[$i][1];
                $valueExcel = $tab[$i][2];
                $dateExcel = $tab[$i][3];
                $sexeExcel = $tab[$i][4];

                $elementDonneeBd = $elementDonneeRepo->findOneBy(["libelle" => $elementDonneeExcel]);
                $provinceBd = $provincesRepository->findOneBy(["Libelle" => $provinceExcel]);

                if ($tab[$i][0] != null) {
                    if (!$elementDonneeBd) {
                        $this->addFlash("info", "l'element de donnee <<" . $elementDonneeBd . ">> n'existe pas dans la base de donee");
                        return $this->redirectToRoute("app_element_donnee_valeur");
                    }elseif (!$provinceBd) {
                        $this->addFlash("info", "la province <<" . $provinceBd . ">> n'existe pas dans la base de donee");
                        return $this->redirectToRoute("app_element_donnee_valeur");
                    } elseif ($elementDonneeBd && $provinceBd) {
                        $enregistrement= $enregistrement+1;
                        $elementDonneeValeur = new ElementDonneeValeur();
                        $elementDonneeValeur->setElementdonnee($elementDonneeBd)
                            ->setProvences($provinceBd)
                            ->setValue($tab[$i][2])
                            ->setDatedata($tab[$i][3])
                            ->setSexe($tab[$i][4]);
                        $em = $doctrine->getManager();
                        $em->persist($elementDonneeValeur);
                        $em->flush();
                    }
                }
            }
            
            // Afficharge de message de confirmation d'enregistrement
            $this->addFlash("success",  $enregistrement . " ligne(s) importer");
            return $this->redirectToRoute("app_element_donnee_valeur");
        } else {
            return $this->render('element_donnee_valeur/importer.html.twig', [
                'formulaire' => $form->createView(),
            ]);
        }
    }


    #[Route('/value/editer/{id}', name: 'app_editer_value')]
    public function editerEducation($id, Request $request, ManagerRegistry $doctrine)
    {
        $valeurRepo = $doctrine->getRepository(ElementDonneeValeur::class);
        $m = $valeurRepo->find($id);

        $form = $this->createForm(ElementDonneValeurType::class, $m);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $m = $form->getData();
            // ENVOIS DANS LA BASE DE DONNEES
            $em = $doctrine->getManager();
            $em->persist($m);
            $em->flush();
            // Afficharge de message de confirmation d'enregistrement
            $this->addFlash("success", "Votre Valeur a été Modifier");

            // REDIRECTION DE LA PAGE
            return $this->redirectToRoute("app_element_donnee_valeur");
        }



        return $this->render("education/editer.html.twig", [
            "formulaire" => $form->createView()
        ]);
    }



    #[Route('/value/supprimer/{id}', name: 'app_supprimer_value')]
    public function supprimerEducation($id, ManagerRegistry $r, Request $request)
    {
        $valeurRepo = $r->getRepository(ElementDonneeValeur::class);
        $valeur = $valeurRepo->find($id);
        // condition de suppression

        if ($valeur) {
            $em = $r->getManager();
            $em->remove($valeur);
            $em->flush();
            // Afficharge de message de confirmation d'enregistrement
            $this->addFlash("success", "Valeur  supprimer");
        } else $this->addFlash("success", "Valeur inexistant");

        return $this->redirect($request->headers->get('referer'));
    }

}
