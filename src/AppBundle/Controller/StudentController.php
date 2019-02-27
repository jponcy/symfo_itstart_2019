<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Student;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class StudentController extends Controller
{

    /**
     * @Route("/student")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository(Student::class);

        /** @var $items Student[] */
        $items = $repository->findAll();

        dump($items);

        $content = '<html><body><h1>Hello world</h1><ul>';

        /** @var $item Student */
        foreach ($items as $item) {
            $content.= '<li>' . $item->getLastname() . ' ' . $item->getFirstname() . '</li>';
        }

        $content.= '</body></html>';

        return new Response($content);
    }

    /**
     * @Route("student/fill")
     */
    public function fillAction()
    {
        $em = $this->getDoctrine()->getManager();

        $e = new Student();
        $e->setLastname('Gaillard');
        $e->setFirstname('Nicolas');

        $em->persist($e);

        $e = new Student();
        $e->setLastname('Dupond');
        $e->setFirstname('Michèle');

        $em->persist($e);

        $em->flush();

        return $this->redirectToRoute('app_student_index');
    }
}

