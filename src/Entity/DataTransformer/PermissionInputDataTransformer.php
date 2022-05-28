<?php

namespace App\Entity\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\DTO\PermissionDTO;
use App\Entity\Permission;
use App\Repository\UserRepository;

class PermissionInputDataTransformer implements DataTransformerInterface
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @param PermissionDTO $object
     * @param string $to
     * @param array $context
     * @return object|void
     */
    public function transform($object, string $to, array $context = [])
    {
        $permission = new Permission();
        $permission->setName($object->getName());

        $parent = $this->repository->getByName($object->getUserName());

        $permission->setParent($parent);

        return $permission;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return Permission::class == $to &&!($data instanceof Permission);
    }
}