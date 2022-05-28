<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getByName(string $name)
    {
        $users = $this->createQueryBuilder('u')
            ->where('LOWER(u.name) =:lower')
            ->setParameter(':lower', mb_strtolower($name))
            ->getQuery()
            ->execute();

        return reset($users);
    }

    public function find($id, $lockMode = null, $lockVersion = null): ?User
    {
        return parent::find($id, $lockMode, $lockVersion);
    }
}