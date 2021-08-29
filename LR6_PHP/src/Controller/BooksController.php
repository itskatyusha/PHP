<?php

namespace App\Controller;

use App\Entity\Books;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BooksController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        /*return $this->render('books/index.html.twig', [
            'controller_name' => 'BooksController',
        ]);*/

        $books = $this->getDoctrine()->getRepository(Books::class)->findAll();

        //dump($books);die;

        return $this->render('books/index.html.twig', ['books' => $books]);

    }
}
