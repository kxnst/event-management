<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'put', 'delete'],
)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string')]
    protected string $name;

    #[ORM\OneToMany(mappedBy: 'parent', targetEntity: Permission::class, cascade: ['persist', 'remove'], fetch: "EAGER", orphanRemoval: true)]
    protected Collection $permissions;

    #[ORM\Column(type: 'string')]
    protected string $messenger;

    #[ORM\Column(type: 'json')]
    protected array $messengerData;

    #[ORM\Column(type: 'boolean')]
    protected bool $confirmed = false;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection
     */
    public function getPermissions(): Collection
    {
        return $this->permissions;
    }

    /**
     * @param Collection $permissions
     */
    public function setPermissions(Collection $permissions): void
    {
        $this->permissions = $permissions;
    }

    /**
     * @return string
     */
    public function getMessenger(): string
    {
        return $this->messenger;
    }

    /**
     * @param string $messenger
     */
    public function setMessenger(string $messenger): void
    {
        $this->messenger = $messenger;
    }

    /**
     * @return array
     */
    public function getMessengerData(): array
    {
        return $this->messengerData;
    }

    /**
     * @param array $messengerData
     */
    public function setMessengerData(array $messengerData): void
    {
        $this->messengerData = $messengerData;
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    /**
     * @param bool $confirmed
     */
    public function setConfirmed(bool $confirmed): void
    {
        $this->confirmed = $confirmed;
    }
}