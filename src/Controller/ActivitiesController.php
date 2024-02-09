<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActivitiesController extends AbstractController
{
    #[Route('/activities', name: 'app_activities')]
    public function userActivities(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        return $this->render('activities/userActivities.html.twig', [
            'controller_name' => 'ActivitiesController',
        ]);
    }
}
