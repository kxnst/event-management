<?php

namespace App\Voters;

use App\Entity\Permission;
use App\Entity\User;
use App\Services\Message\MessageService;
use App\Services\PermissionService;
use App\Services\UserService;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class EventVoter extends Voter
{
    public function __construct(
        private PermissionService $permissionService,
        private UserService $userService,
        private MessageService $messageService
    )
    {
    }

    protected function supports(string $attribute, mixed $subject): bool
    {
        return in_array($attribute, ['post', 'delete']);
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $this->userService->getUser();

        /** @var User $user */
        $user = reset($user);
        if (!$user) {
            return false;
        }

        $result =  $this->permissionService->isUserAllowed($user, Permission::PERMISSION_EVENT);

        if(!$result) {
            $this->messageService->sendMessage($user, 'You are not allowed to create event!!!');
        }

        return $result;
    }
}