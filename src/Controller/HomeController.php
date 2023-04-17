<?php

namespace App\Controller;

use App\Entity\PortfolioTag;
use App\Entity\Realisation;
use App\Repository\PortfolioRepository;
use App\Repository\PortfolioTagRepository;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(RealisationRepository $realisationRepository, PortfolioRepository $portfolioRepository, PortfolioTagRepository $portfolioTagRepository): Response
    {

        $listeDesRealisations = $realisationRepository->findAll(); 
        $portfolios= $portfolioRepository->findAll();
        $tags = $portfolioTagRepository->findAll();


        return $this->render('home/index.html.twig', [
            'listeDesRealisations' => $listeDesRealisations,
            'portfolios' => $portfolios,
            'tags' => $tags,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/realisation/{id}', name: 'app_realisation_detail')]
    public function blogDetails(Realisation $realisation, RealisationRepository $realisationRepository ): Response
    {

        // récupère les ids dans un tableau pour pagination
        $listeDesRealisations = $realisationRepository->findAll();
        $listId = [];
        $precedent = null;
        $suivant= null;

        foreach ($listeDesRealisations as $key => $realisationCourante) {
            $listId[] = $realisationCourante->getId();
            // récupérer la clé correspondante a l'id courant
            if ($realisationCourante->getId() == $realisation->getId())
                $currentKey = $key;
            }

            $number = count($listId);
        
            // si la clé est la première alors tu affiche la dernière sur précédent
            if ($currentKey == 0) {
                $precedent = $number-1;
                $suivant= $currentKey+1;


            }
            // si la clé est la derniere, tu adffiches la premiere sur suivant
            else if ($currentKey == $number-1) {
                $precedent = $currentKey-1;
                $suivant= 0;
            }
            else {
                $precedent = $currentKey-1;
                $suivant=  $currentKey+1;
            }


        return $this->render('pages/realisation-detail.html.twig', [
            'realisation' => $realisation,
            'listId' => $listId,
            'precedent' => $precedent,
            'suivant' => $suivant,
            'controller_name' => 'HomeController',
        ]);
    }
}
