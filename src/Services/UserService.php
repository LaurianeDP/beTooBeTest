<?php

namespace App\Services;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{

    public function __construct(
        protected UserRepository $userRepository, private EntityManagerInterface $entityManager
    ) {}

    public function validateUser(string $userId):void {
        $userToValidate = $this->userRepository->find($userId);
        $userToValidate->setAccountActive(true);

        $this->entityManager->persist($userToValidate);
        $this->entityManager->flush();
    }
}