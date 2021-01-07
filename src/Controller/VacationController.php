<?php

namespace App\Controller;

use App\Entity\Vacation;
use App\Form\VacationType;
use App\Service\Helper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VacationController extends AbstractController
{
    /**
     * @Route("/vacation", name="vacation")
     * @param Helper $helper
     * @return Response
     *
     */
    public function index(Helper $helper): Response
    {
        return $this->render('vacation/index.html.twig', [
            'vacations' => $helper->getCompany()->getVacations(),
        ]);
    }
    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/vacation/add", name="vacation_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function add(Request $request, Helper $helper): Response
    {
        $vacation = new Vacation();
        $form = $this->createForm(VacationType::class, $vacation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacation->setCompany($helper->getCompany());
            $vacation->setEmployee($helper->getEmployee());
            $vacation->setVacationStatus("not_accepted");
            $em = $this->getDoctrine()->getManager();
            $em->persist($vacation);
            $em->flush();
            $this->addFlash('success', 'Pomyślnie dodano urlop');

            return $this->redirectToRoute('vacation');
        }

        return $this->render('vacation/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}
