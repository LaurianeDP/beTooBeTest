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

        // Filters activities where:
        // the user is not already signed up, the user meets the age requirement, and the activity has not reached its maximum amount of participants

        // TODO: add logic to calculate user age using a DateTime library, for example Carbon
        $userAge = 10;

        $qb = $this->createQueryBuilder('activity')
                ->where('activity.ageRequirement <= :userAge')
                ->andWhere(':user NOT IN activity.participants')
                // Syntax is false, placeholder to show the logic to be used
                ->andWhere('COUNT(participant.id) < activity.maximumParticipants')
                ->setParameter('user', $connectedUser)
                ->setParameter('userAge', $userAge)
            ;


        return $qb->getQuery()->getResult();
    }

    public function unsignUserFromActivity(User $user, string $activityId): void {
        $activitySelected = $this->activityRepository->find($activityId);

        $activitySelected->removeParticipant($user);

        $this->entityManager->persist($activitySelected);
        $this->entityManager->flush();
    }
}