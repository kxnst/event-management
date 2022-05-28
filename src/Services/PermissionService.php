<?php

namespace App\Services;

use App\Entity\Permission;
use App\Entity\User;

class PermissionService
{
    public function isUserAllowed(User $user, string $permission)
    {
        /** @var Permission $userPermission */
        foreach ($user->getPermissions() as $userPermission) {
            if($userPermission->getName() == $permission)
            {
                return true;
            }
        }

        return false;
    }
}