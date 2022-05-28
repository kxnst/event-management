<?php

namespace App\Services;

use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class UserService
{
    private Request $request;

    public function __construct(RequestStack $requestStack, private UserRepository $userRepository)
    {
        $this->request = $requestStack->getCurrentRequest();
    }

    public function getUser()
    {
        $requestData = json_decode($this->request->getContent(), true);

        return match ($requestData['messenger']) {
            'telegram' => $this->userRepository->findBy(['name' => $requestData['messengerData']['login']]),
            default => null,
        };
    }
}