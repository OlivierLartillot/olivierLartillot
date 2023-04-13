<?php

namespace App\Controller;

use App\Repository\RealisationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(RealisationRepository $realisationRepository): Response
    {

        $listeDesRealisations = $realisationRepository->findAll(); 



        return $this->render('home/index.html.twig', [
            'listeDesRealisations' => $listeDesRealisations,
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/blog-details', name: 'app_details')]
    public function blogDetails(): Response
    {
        return $this->render('pages/blog-light.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
