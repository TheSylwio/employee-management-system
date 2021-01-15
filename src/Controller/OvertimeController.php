<?php

namespace App\Controller;

use App\Entity\Overtime;
use App\Entity\OvertimeDisposition;
use App\Form\OvertimeStatusType;
use App\Form\OvertimeType;
use App\Service\Helper;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OvertimeController extends AbstractController
{
    /**
     * @Route("/overtime", name="overtime")
     * @param Helper $helper
     */
    public function index(Helper $helper): Response
    {
        $repo=$this->getDoctrine()->getRepository(Overtime::class);
        $overtime=$repo->findAll();
        return $this->render('overtime/index.html.twig', [
            'employee'=>$helper->getEmployee(),
            'overtime' => $overtime
        ]);
    }
    /**
     * @Route("/overtime/disposition", name="disposition")
     * @param Helper $helper
     */
    public function disposition(Helper $helper): Response
    {
        $repo=$this->getDoctrine()->getRepository(Overtime::class);
        $overtime=$repo->findAll();
        return $this->render('overtime/disposition.html.twig', [
            'employee'=>$helper->getEmployee(),
            'overtime' => $overtime
        ]);
    }
    /**
     * @Route("/overtime/add}", name="overtime_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function add(Request $request, Helper $helper): Response
    {
        $overtime = new Overtime();
        $form = $this->createForm(OvertimeType::class,$overtime);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $overtime
                ->setCompany($helper->getCompany())
                ->setEmployee($helper->getEmployee())
                ->setStatus("disposition");
            $em = $this->getDoctrine()->getManager();
            $em->persist($overtime );
            $em->flush();
            $this->addFlash('success', 'Pomyślnie dodano dyspozycję');
            return $this->redirectToRoute('disposition');
        }
        return $this->render('overtime/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/overtime/{overtime}/edit", name="overtime_edit")
     * @param Request $request
     * @param Overtime $overtime
     * @return Response
     */
    public function edit(Request $request, Overtime $overtime): Response
    {
        $form = $this->createForm(OvertimeStatusType::class,$overtime);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $overtime->setStartDate($overtime->getStartDate());
            $overtime->setEndDate($overtime->getEndDate());

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zatwierdzono nadgodziny');

            return $this->redirectToRoute('disposition');
        }

        return $this->render('overtime/edit.html.twig', [
            'disposition' =>$overtime,
            'form' => $form->createView(),
        ]);
    }
}
