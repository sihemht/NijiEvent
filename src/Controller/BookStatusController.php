<?php

namespace App\Controller;

use App\Entity\Books;
use Symfony\Component\Workflow\Registry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookStatusController extends AbstractController
{
    private $workflowRegistry;

    public function __construct(Registry $workflowRegistry)
    {
        $this->workflowRegistry = $workflowRegistry;
    }

    #[Route('/{id}/start-reading', name: 'app_books_start_reading', methods: ['POST'])]
    public function startReading(Books $book, EntityManagerInterface $entityManager): Response
    {
        $workflow = $this->workflowRegistry->get($book);

        if ($workflow->can($book, 'start_reading')) {
            $workflow->apply($book, 'start_reading');
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_books_show', ['id' => $book->getId()]);
    }

    #[Route('/{id}/finish-reading', name: 'app_books_finish_reading', methods: ['POST'])]
    public function finishReading(Books $book, EntityManagerInterface $entityManager): Response
    {
        $workflow = $this->workflowRegistry->get($book);

        if ($workflow->can($book, 'finish_reading')) {
            $workflow->apply($book, 'finish_reading');
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_books_show', ['id' => $book->getId()]);
    }

    #[Route('/{id}/abandon-reading', name: 'app_books_abandon_reading', methods: ['POST'])]
    public function abandonReading(Books $book, EntityManagerInterface $entityManager): Response
    {
        $workflow = $this->workflowRegistry->get($book);

        if ($workflow->can($book, 'abandon_reading')) {
            $workflow->apply($book, 'abandon_reading');
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_books_show', ['id' => $book->getId()]);
    }

    #[Route('/{id}/never-read', name: 'app_books_never_read', methods: ['POST'])]
    public function neverRead(Books $book, EntityManagerInterface $entityManager): Response
    {
        $workflow = $this->workflowRegistry->get($book);

        if ($workflow->can($book, 'never_read')) {
            $workflow->apply($book, 'never_read');
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_books_show', ['id' => $book->getId()]);
    }
}
