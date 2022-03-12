<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book', name: 'book_', methods: 'GET')]
class BookController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'route_name_of_controller' => 'book_index',
        ]);
    }

    #[Route('/all', name: 'all')]
    public function fetchAllBooks(BookRepository $bookRepository): Response
    {
        $books = $bookRepository->findAll();

        // if (empty($books)) {
        //     return new Response(
        //         "No data found",
        //         Response::HTTP_NOT_FOUND,
        //         ['content-type' => 'text/plain']
        //     );
        // }

        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
            'route_name_of_controller' => 'book_all',
            'books' => $books,
        ]);
    }

    #[Route('/create/book', name: 'create_book', methods: 'POST')]
    public function createBook(Request $request, EntityManagerInterface $entityManager): Response
    {
        $title = $request->get('title');
        $isbn = $request->get('isbn');
        $author = $request->get('author');
        $image = $request->get('image');

        $book = new Book();
        $book->setTitle($title);
        $book->setIsbn($isbn);
        $book->setAuthor($author);
        $book->setImage($image);

        $entityManager->persist($book);
        $entityManager->flush();

        return new Response("A new book is now created and saved into the table book in the test database!");
    }
}
