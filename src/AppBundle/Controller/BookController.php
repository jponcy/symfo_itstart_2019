<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BookController extends Controller
{

    /**
     * @Route("book")
     */
    public function indexAction()
    {
        $entities = $this->getDoctrine()->getRepository(Book::class)->findAll();

        return $this->render('book/index.html.twig', [
            'books' => $entities
        ]);
    }

//     /**
//      * @Route("book/{id}/show")
//      */
//     public function showAction(int $id)
//     {
//         $book = $this->getDoctrine()->getRepository(Book::class)->find($id);

//         return $this->render('book/show.html.twig', [
//             'book' => $book
//         ]);
//     }

    /**
     * @Route("book/{id}/show")
     * Template() deprecie du a une perte de performences car il doit determiner lui meme quel est le template
     * @Template(template="book/show.html.twig") - Syntax tolere du Template
     * @param Book $book
     */
    public function showAction(Book $book) // Utilisation implicite de ParamConverters.
    {
        return [
            'book' => $book
        ];
    }
}
