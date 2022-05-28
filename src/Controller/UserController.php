<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Message\MessageService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route(path: '/api/users/{id}/confirm')]
    public function confirm(EntityManagerInterface $entityManager, int $id, UserRepository $repository, MessageService $service)
    {
        $user = $repository->find($id);
        $user->setConfirmed(true);

        $entityManager->persist($user);
        $entityManager->flush();

        $service->sendMessage($user, 'Successfully confirmed!!!');

        return $this->json($user);
    }
}