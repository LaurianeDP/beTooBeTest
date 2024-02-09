<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Entity\Activity;
use App\Services\ActivityService;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class ActivityCard
{
    use DefaultActionTrait;

    public Activity $activityComp;
    public User $user;
    public $displayActivity = true;

    // TODO: add conditional display attribute if the user is on the Home or Activities page
    // Use current active route to figure this out

    public function __construct(private ActivityService $activityService)
    {}

    #[LiveAction]
    public function leaveActivity(#[LiveArg] string $activityId)
    {
        $this->activityService->unsignUserFromActivity($user, $activityId);
        $this->displayActivity = false;
    }
}
