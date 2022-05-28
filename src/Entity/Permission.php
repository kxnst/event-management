<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\DTO\PermissionDTO;
use App\Entity\Traits\HasParentTrait;
use App\Repository\PermissionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Ignore;

#[ORM\Entity(repositoryClass: PermissionRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'post' => ['security' => 'is_granted("post")']
    ],
    itemOperations: [
        'get',
        'delete' => ['security' => 'is_granted("delete")']
    ],
    input: PermissionDTO::class,
    output: PermissionDTO::class
)]
class Permission
{
    use HasParentTrait;

    public const PERMISSION_PERMISSION = 'permission';

    public const PERMISSION_EVENT = 'event';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string')]
    protected string $name;

    #[Ignore]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private User $parent;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

}