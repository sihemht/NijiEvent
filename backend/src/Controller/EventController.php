<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\EventRepository;
use Symfony\Component\Workflow\Registry;

#[Route('api/')]
class EventController extends AbstractController
{

    public function __construct(private readonly Registry $registry){


    }
    #[Route('events' ,name: 'list_event')]
    public function index(EventRepository $eventRepository): JsonResponse
    {
        $events = $eventRepository->findAll();
        
        $data = [];
        foreach ($events as $event) {
            $data[] = [
                'id' => $event->getId(),
                'title' => $event->getTitle(),
                'time' => $event->getSpeed(),
                'picture' => $event->getPicture(),
                'proposed_date' => $event->getProposedDate(),
                'description' => $event->getDescription(),
                'speaker_username' => $event->getSpeakerUsername(),
                'current_state' => $event->getCurrentState(),
            ];
        }
        return new JsonResponse($data);
    }
}
