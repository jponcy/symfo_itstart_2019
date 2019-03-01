<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\AuthorType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Author;

class AuthorController extends Controller
{

    /**
     * @Route("author/create")
     * @Method({"GET", "POST"})
     */
    public function createAction(Request $request)
    {
        return $this->createOrEdit($request, new Author());
    }

    /**
     * @Route("author")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('author/index.html.twig', [
            'entities' => $this->getRepository()->findAll()
        ]);
    }

    /**
     * @Route("author/{id}/show", requirements={"id": "^\d+$"})
     * @Method("GET")
     */
    public function showAction(Author $author)
    {
        return $this->render('author/show.html.twig', [
            'entity' => $author
        ]);
    }

    /**
     * @Route("author/{id}/edit", requirements={"id": "^\d+$"})
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Author $author)
    {
        return $this->createOrEdit($request, $author);
    }

    /**
     * @Route("author/{id}/delete", requirements={"id": "^\d+$"})
     * @Method("GET")
     */
    public function deleteAction(Author $author)
    {
        $manager = $this->getDoctrine()->getManager();

        $manager->remove($author);
        $manager->flush();

        $this->addFlash('success', 'Suppression réussi');

        return $this->redirectToRoute('app_author_index');
    }

    private function createOrEdit(Request $request, Author $author)
    {
        $form = $this->createForm(AuthorType::class, $author);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $manager->persist($author);
            $manager->flush();

            return $this->redirectToRoute('app_author_index');
        }

        return $this->render('author/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    private function getRepository()
    { return $this->getDoctrine()->getRepository(Author::class); }
}
