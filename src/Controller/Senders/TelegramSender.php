<?php

namespace App\Controller\Senders;

use App\Entity\Message;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TelegramSender extends AbstractSender
{
    protected string $chatId;

    private HttpClientInterface $client;

    public function __construct(string $telegramUrl, HttpClientInterface $client, string $telegramChatId)
    {
        $this->client = $client;
        $this->apiUrl = $telegramUrl;
        $this->chatId = $telegramChatId;
    }

    public function send(Message $message)
    {
        $messageInfo = "Should be sent through: " . $message->getUser()->getMessenger() . " 
        to: " . $message->getUser()->getName() . "  
          ";

        $messageString = $messageInfo . $message->getMessage();

        $query = http_build_query([
            'text' => $messageString,
            'chat_id' => $this->chatId
        ]);
        $this->client->request('POST', $this->apiUrl . '?' . $query);
    }
}