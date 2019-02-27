<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Company;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends Controller
{
    /**
     * @Route("company")
     */
    public function indexAction()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository(Company::class);
        $entities = $repo->findAll();

        dump($entities);

        $content = '<html><body>';
        $content.= count($entities) . ' compan' . (count($entities) > 1 ? 'ies' : 'y');
        $content.= '</body></html>';

        return new Response($content);
    }

//     /**
//      * @Route("company/fill")
//      */
//     public function fillAction()
//     {
//         $manager = $this->getDoctrine()->getManager();
//         $entities = $manager->getRepository(Company::class)->findAll();
//         $names = [];
//         foreach ($entities as $e) {
//             array_push($names, $e->getName());
//         }

//         foreach (['farsigth', 'centravet', 'o-mega'] as $name) {
//             if (array_search($name, $names) === false) {
//                 $e = new Company();

//                 $e->setName($name);

//                 $manager->persist($e);
//             }
//         }

//         $manager->flush();

//         return $this->redirectToRoute('app_company_index');
//     }

    /**
     * @Route("company/fill")
     */
    public function fillAction()
    {
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository(Company::class);

        foreach (['farsigth', 'centravet', 'o-mega'] as $name) {
            if (!$repo->findOneByName($name)) {
                $e = new Company();

                $e->setName($name);

                $manager->persist($e);
            }
        }

        $manager->flush();

        return $this->redirectToRoute('app_company_index');
    }
}
