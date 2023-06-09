<?php

namespace App\Controller\Admin;

use App\Entity\ImageRealisation;
use App\Entity\Portfolio;
use App\Entity\PortfolioClass;
use App\Entity\PortfolioTag;
use App\Entity\Realisation;
use App\Entity\Reseau;
use App\Entity\TechnicalStack;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('OlivierDevWebThemeForest');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::subMenu('Gestion Portfolio', 'fa-solid fa-image') 
            ->setSubItems([
                MenuItem::linkToCrud('Réalisations', 'fas fa-pencil', Realisation::class),
                MenuItem::linkToCrud('images Slider', 'fas fa-pencil', ImageRealisation::class),

                MenuItem::linkToCrud('Stack', 'fas fa-rocket', TechnicalStack::class),

        ]);




        yield MenuItem::subMenu('Gestion Portfolio', 'fa-solid fa-image') 
            ->setSubItems([
                MenuItem::linkToCrud('Portfolio', 'fas fa-window-restore', Portfolio::class),
                MenuItem::linkToCrud('class', 'fas fa-file', PortfolioClass::class),
                MenuItem::linkToCrud('tag', 'fas fa-tags', PortfolioTag::class),
            ]);
        yield MenuItem::linkToCrud('Réseaux Sociaux', 'fas fa-thumbs-up', Reseau::class);
        
    }
}
