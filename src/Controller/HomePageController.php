<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route('/home', name: 'app_home_page')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        $connectedUser = $this->getUser();

        if(in_array('ROLE_ADMIN', $connectedUser->getRoles())) {
            return $this->redirectToRoute('app_admin_dashboard');
        }

        return $this->render('home_page/homePage.html.twig', [
            'user' => $connectedUser,
        ]);
    }
}
