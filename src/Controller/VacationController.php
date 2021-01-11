<?php

namespace App\Controller;

use App\Entity\Vacation;
use App\Form\VacationStatusType;
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
     */
    public function index(Helper $helper): Response
    {
        $vacations = $helper->getCompany()->getVacations();

        return $this->render('vacation/index.html.twig', [
            'acceptedVacations' => $vacations->filter(fn(Vacation $vacation) => $vacation->getStatus() === 'accepted'),
            'waitingVacations' => $vacations->filter(fn(Vacation $vacation) => $vacation->getStatus() === 'waiting_for_accept'),
            'rejectedVacations' => $vacations->filter(fn(Vacation $vacation) => $vacation->getStatus() === 'rejected'),
        ]);
    }

    /**
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
            $vacation
                ->setCompany($helper->getCompany())
                ->setEmployee($helper->getEmployee())
                ->setStatus("waiting_for_accept");

            $em = $this->getDoctrine()->getManager();
            $em->persist($vacation);
            $em->flush();

            $this->addFlash('success', 'Pomyślnie złożono wniosek o urlop');
            return $this->redirectToRoute('vacation');
        }

        return $this->render('vacation/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/vacation/{vacation}/edit", name="vacation_edit")
     * @param Request $request
     * @param Vacation $vacation
     * @return Response
     */
    public function edit(Request $request, Vacation $vacation): Response
    {
        $form = $this->createForm(VacationStatusType::class, $vacation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $vacation->setStartDate($vacation->getStartDate());
            $vacation->setEndDate($vacation->getEndDate());

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zmieniono dane');

            return $this->redirectToRoute('vacation');
        }

        return $this->render('vacation/edit.html.twig', [
            'vacation' => $vacation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/vacation/{vacation}/confirm", name="vacation_confirm")
     * @param Vacation $vacation
     * @return Response
     */
    public function confirm(Vacation $vacation): Response
    {
        $vacation->setStatus('accepted');

        $em = $this->getDoctrine()->getManager();
        $em->persist($vacation);
        $em->flush();

        $this->addFlash('success', 'Pomyślnie zatwierdzono wniosek o urlop');
        return $this->redirectToRoute('vacation');
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/vacation/{vacation}/reject", name="vacation_reject")
     * @param Vacation $vacation
     * @return Response
     */
    public function reject(Vacation $vacation): Response
    {
        $vacation->setStatus('rejected');

        $em = $this->getDoctrine()->getManager();
        $em->persist($vacation);
        $em->flush();

        $this->addFlash('success', 'Pomyślnie odrzucono wniosek o urlop');
        return $this->redirectToRoute('vacation');
    }
}
