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
$v = [1, 2, 3];
$v['value'] = 'DEZ';
array_push($v, 42);
        return $this->render('company/index.html.twig', [
            'msg' => 'Salut !',
            'entities' => $entities,
            'nb' => count($entities),
            'values' => $v
        ]);
    }

    /**
     * @Route("company/{id}/show")
     */
    public function showAction(int $id)
    {
        $repo = $this->getDoctrine()->getRepository(Company::class);
        $company = $repo->find($id);

        return $this->render('company/show.html.twig', [
            'entity' => $company
        ]);
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
