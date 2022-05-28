<?php

namespace App\Entity\Traits;

trait HasMessengerInfoTrait
{
    protected string $messenger;

    protected array $messengerData;

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


}