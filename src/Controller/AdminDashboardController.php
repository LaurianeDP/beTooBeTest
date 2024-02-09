<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminDashboardController extends AbstractController
{

    public function __construct(
        protected UserRepository $userRepository
    ) {}


    #[Route('/admin', name: 'app_admin_dashboard')]
    public function index(): Response
    {
        $unvalidatedUsers= $this->userRepository->findBy(['accountActive' => false]);

        // TODO: add the list of activities to be displayed on admin page

        return $this->render('admin_dashboard/adminDashboard.html.twig', [
            'usersToValidate' => $unvalidatedUsers,
        ]);
    }
}
