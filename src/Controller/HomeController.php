<?php

namespace App\Controller;

use App\Entity\Realisation;
use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(RealisationRepository $realisationRepository): Response
    {

        $listeDesRealisations = $realisationRepository->findAll(); 



        return $this->render('home/index.html.twig', [
            'listeDesRealisations' => $listeDesRealisations,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/realisation/{id}', name: 'app_realisation_detail')]
    public function blogDetails(Realisation $realisation ): Response
    {
        
        return $this->render('pages/realisation-detail.html.twig', [
            'realisation' => $realisation,
            'controller_name' => 'HomeController',
        ]);
    }
}
