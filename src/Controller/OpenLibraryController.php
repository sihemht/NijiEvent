<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use App\Service\OpenLibraryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Books;

#[AsController]
class OpenLibraryController extends AbstractController
{
    private $openLibraryService;

    public function __construct(OpenLibraryService $openLibraryService)
    {
        $this->openLibraryService = $openLibraryService;
    }

    #[Route('/search-books', name: 'search_books', methods: ['GET'])]
    public function searchBooks(Request $request)
    {
        $query = $request->query->get('query');

        $books = [];
        if ($query) {
            try {
                $books = $this->openLibraryService->searchBooks($query);
            } catch (\Exception $e) {
                $this->addFlash('error', 'An error occurred while searching for books.');
            }
        }

        return $this->render('open_library/index.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route('/book-details/{olid}', name: 'book_details', methods: ['GET'])]
    public function getBookDetails(string $olid): JsonResponse
    {
        try {
            $details = $this->openLibraryService->getBookDetails($olid);
            return new JsonResponse($details);
        } catch (\Exception $e) {
            return new JsonResponse(['error' => $e->getMessage()], 500);
        }
    }

    #[Route('/add-book', name: 'add_book', methods: ['POST'])]
    public function addBook(Request $request, EntityManagerInterface $entityManager)
    {

        $title = $request->request->get('title');
        $authors = $request->request->all('authors');
        $imageCover = $request->request->get('image_cover');

        if (is_array($authors)) {
            $authors = implode(', ', $authors);
        }

        $book = new Books();
        $book->setTitle($title);
        $book->setAuthorsText($authors);
        $book->setImageCover($imageCover);

        $entityManager->persist($book);
        $entityManager->flush();

        return $this->redirectToRoute('app_books_index');
    }

}
