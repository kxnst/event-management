<?php

namespace App\Controller\Senders;

use App\Entity\Message;

abstract class AbstractSender
{
    protected string $apiUrl;

    public abstract function send(Message $message);
}