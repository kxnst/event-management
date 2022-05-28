<?php

namespace App\DTO;

use App\Entity\Traits\HasMessengerInfoTrait;

class EventDTO
{
    use HasMessengerInfoTrait;

    protected int $id;

    protected string $dateTime;

    protected string $description;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
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