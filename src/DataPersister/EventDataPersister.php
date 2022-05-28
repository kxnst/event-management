<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Event;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Message\MessageService;

class EventDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private UserRepository                     $userRepository,
        private MessageService                     $messageService,
        private ContextAwareDataPersisterInterface $decorated
    )
    {
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof Event;
    }

    /**
     * @param Event $data
     * @param array $context
     * @return object|void
     */
    public function persist($data, array $context = [])
    {
        $result = $this->decorated->persist($data, $context);

        $oldEvent = $context['previous_data'] ?? null;

        if (!$oldEvent instanceof Event) {
            $text = "New Event!!! Date: {$data->getDateTime()} Description: {$data->getDescription()}";
        } else {
            $text = "Event Updated!!! 
            Old date: {$oldEvent->getDateTime()} 
            New Date: {$data->getDateTime()}
             Description: {$data->getDescription()}";
        }
        /** @var User $user */
        foreach ($this->userRepository->findAll() as $user) {

            $this->messageService->sendMessage($user, $text);
        }

        return $result;
    }

    public function remove($data, array $context = [])
    {
        return $data;
    }
}