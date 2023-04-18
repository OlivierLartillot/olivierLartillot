<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Realisation;
use App\Form\ContactType;
use App\Repository\PortfolioRepository;
use App\Repository\PortfolioTagRepository;
use App\Repository\RealisationRepository;
use App\Repository\ReseauRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods:['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $manager, 
                                            MailerInterface $mailer, 
                                            RealisationRepository $realisationRepository, 
                                            PortfolioRepository $portfolioRepository, 
                                            PortfolioTagRepository $portfolioTagRepository,
                                            ReseauRepository $reseauRepository
    ): Response
    {

        $listeDesRealisations = $realisationRepository->findAll(); 
        $portfolios= $portfolioRepository->findAll();
        $tags = $portfolioTagRepository->findAll();
        $reseaux = $reseauRepository->findBy(['published' => true]); 


        // formulaire de contact
            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);

            $form->handleRequest($request);

            if($form->isSubmitted() && !$form->isValid()){ 

                $this->addFlash(
                    'error',
                    'Le message n\'a pas été envoyé car le formulaire contient des erreurs. Veuillez vérifier avant de le soumettre  à nouveau.'
                );
                
            }

            if($form->isSubmitted() && $form->isValid()){
                
                $contact = $form->getData();
                //$score = $recaptcha3Validator->getLastResponse()->getScore();
                $manager->persist($contact);
                $manager->flush();
    
                //Email
                $email = (new TemplatedEmail())
                ->from('contact@olivier.com')
                ->to('olivier.lartillot@gmail.com')
                ->subject($contact->getSubject())
                // path of the Twig template to render
                ->htmlTemplate('emails/contact.html.twig') 
                // pass variables (name => value) to the template
                ->context([
                    'contact' => $contact, 
                ]
            );
    
                $mailer->send($email);

                $this->addFlash(
                    'success',
                    'Votre demande a été envoyée avec succés !'
                );
                return $this->redirectToRoute('app_home');
    
            }



        return $this->render('home/index.html.twig', [
            'listeDesRealisations' => $listeDesRealisations,
            'portfolios' => $portfolios,
            'tags' => $tags,
            'form' => $form,
            'controller_name' => 'HomeController',
            'reseaux' => $reseaux
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
