<?php

namespace App\Twig\Components;

use App\Entity\User;
use App\Services\UserService;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;

#[AsLiveComponent]
final class UserCard
{
    use DefaultActionTrait;

    public User $userComp;
    public $displayUser = true;

    public function __construct(private UserService $userService)
    {}

    #[LiveAction]
    public function activateUser(#[LiveArg] string $userId)
    {
        $this->userService->validateUser($userId);
        $this->displayUser = false;
    }
}
