<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Book;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Form\BookType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BookController extends Controller
{

    /**
     * @Route("book")
     * @Method("GET")
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
     * @Method("GET")
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

    /**
     * @Route("book/create")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        $book = new Book();
        $errors = [];

        // Traitement du formulaire ; des valeurs saisies.
        if ($request->isMethod("POST")) {
            // Recuperation des valeurs a partir du formulaire.
            $name = $request->request->get('name');
            $price = $request->request->get('price');
            $stock = $request->request->get('stock');
            $author = $request->request->get('author');
            $description = $request->request->get('description');

            // Remplissage de l'objet.
            $book->setName(trim($name));
            $book->setAuthor(trim($author));
            $book->setDescription(trim($description));
            $book->setPrice($price ? floatval($price) : null);
            $book->setStock($stock ? intval($stock) : null);

            // Validation des saisies de l'utilisateur.
            if ($book->getName() === '') {
                $errors['name'] = 'Ne doit pas être vide';
            }
            if ($book->getDescription() === '') {
                $errors['description'] = 'Ne doit pas être vide';
            }
            if ($book->getAuthor() === '') {
                $errors['author'] = 'Ne doit pas être vide';
            }
            if ($book->getPrice() === null) {
                $errors['price'] = 'Ne doit pas être vide';
            }
            if ($book->getStock() === null) {
                $errors['stock'] = 'Ne doit pas être vide';
            }

            if (count($errors) === 0) { // Si pas d'erreur trouvee.
                // Sauvegarde.
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($book);
                $manager->flush();

                // Redirection vers la liste des livres.
                return $this->redirectToRoute('app_book_index');
            }
        }

        // Si la methode etait GET ou des erreurs.
        return $this->render('book/create.html.twig', [
            'request' => $request,
            'book' => $book,
            'errors' => $errors
        ]);
    } // ! create.

    /**
     * @Route("book/{id}/edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Book $book, Request $request)
    {
        // Creation du formulaire.
        $fb = $this->createForm(BookType::class, $book);

        // Ajout du bouton submit (ne doit pas etre present dans la class BookType)
        $fb->add('submit', SubmitType::class, ['label' => 'Modifier']);

        // Mise a jour du modele par rapport aux parametres presents dans Request.
        $fb->handleRequest($request);

        // Verification si sauvegarde.
        if ($fb->isSubmitted() && $fb->isValid()) {
            // Sauvegarde.
            $manager = $this->manager();
            $manager->persist($book);
            $manager->flush();

            // Redirection vers la liste des livres.
            return $this->redirectToRoute('app_book_index');
        }

        // Si le formulaire n'a pas encore ete envoye par l'utilisateur ou qu'il y a des erreurs.
        return $this->render('book/edit.html.twig', [
            'form' => $fb->createView()
        ]);
    }

    /**
     * @Route("book/{id}/delete")
     * @param Book $book
     */
    public function deleteAction(Book $book)
    {
//         $this->manager()->remove($book);
//         $this->manager()->flush();

        $this->addFlash('success', 'Suppression réussie');

        return $this->redirectToRoute('app_book_index');
    }

    protected function manager()
    { return $this->getDoctrine()->getManager(); }
}
