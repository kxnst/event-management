<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\DTO\EventDTO;
use App\Repository\EventRepository;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;

#[Entity(repositoryClass: EventRepository::class)]
#[ApiResource(
    collectionOperations: [
        'get',
        'post' => ['security' => 'is_granted("post")']
    ],
    itemOperations: [
        'get',
        'delete' => ['security' => 'is_granted("delete")'],
        'put' => ['security' => 'is_granted("delete")']
    ],
    input: EventDTO::class,
    output: EventDTO::class
)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    protected $id;

    #[ORM\Column(type: 'string')]
    protected string $dateTime;

    #[ORM\Column(type: 'string')]
    protected string $description;

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getDateTime(): string
    {
        return $this->dateTime;
    }

    /**
     * @param string $dateTime
     */
    public function setDateTime(string $dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}