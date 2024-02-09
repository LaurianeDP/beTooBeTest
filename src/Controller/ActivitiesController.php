<?php

namespace App\Controller;

use App\Services\ActivityService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActivitiesController extends AbstractController
{
    public function __construct(protected ActivityService $activityService) {}


    #[Route('/activities', name: 'app_activities')]
    public function userActivities(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED');

        // TODO: add call to activityService to get a valid activities list for the connected user
        // $validUserActivities = $this->activityService->getValidUserActivities($this->getUser());

        return $this->render('activities/userActivities.html.twig', [
            // 'userActivities' => $validUserActivities,
        ]);
    }
}
