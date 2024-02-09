<?php

namespace App\Services;

use App\Repository\ActivityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Collection;

class ActivityService
{

    public function __construct(
        protected ActivityRepository $activityRepository, private EntityManagerInterface $entityManager
    ) {}

    public function getValidUserActivities(User $user): array {
        $validUserActivities = [];
        $connectedUser = $user->getId();

        // TODO: filter activities where: the user is not already signed up, the user meets the age requirement

        return $validUserActivities;
    }

    public function unsignUserFromActivity(User $user, string $activityId): void {
        $activitySelected = $this->activityRepository->find($activityId);

        $activitySelected->removeParticipant($user);
        
        $this->entityManager->persist($activitySelected);
        $this->entityManager->flush();
    }
}