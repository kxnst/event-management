<?php

namespace App\Services\Message;

use App\Controller\Senders\TelegramSender;
use App\Entity\Message;
use App\Entity\User;

class MessageService
{
    public function __construct(private TelegramSender $telegramSender)
    {

    }

    public function sendMessage(User $user, string $messageString)
    {
        $message = new Message($user, $messageString);

        $this->telegramSender->send($message);
    }
}