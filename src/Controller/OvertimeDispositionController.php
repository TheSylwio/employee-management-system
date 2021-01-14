<?php

namespace App\Controller;

use App\Entity\OvertimeDisposition;
use App\Form\OvertimeDispositionType;
use App\Service\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OvertimeDispositionController extends AbstractController
{
     /**
     * @Route("/overtime/disposition", name="overtime_disposition")
     * @param Helper $helper
     * @return Response
     */
    public function index(Helper $helper): Response
    {
        $repo=$this->getDoctrine()->getRepository(OvertimeDisposition::class);
        $overtimeDescription=$repo->findAll();
        return $this->render('overtime_disposition/index.html.twig', [
            'employee'=>$helper->getEmployee(),
            'overtimeDisposition' => $overtimeDescription
        ]);
    }
    /**
     * @Route("/overtime/disposition/add", name="overtime_disposition_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function add(Request $request, Helper $helper): Response
    {
        $disposition = new OvertimeDisposition();
        $form = $this->createForm(OvertimeDispositionType::class,$disposition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $disposition
                ->setCompany($helper->getCompany())
                ->setEmployee($helper->getEmployee());
            $em = $this->getDoctrine()->getManager();
            $em->persist($disposition);
            $em->flush();
            $this->addFlash('success', 'Pomyślnie dodano dyspozycję nadgodzin');
            return $this->redirectToRoute('overtime_disposition');
        }
        return $this->render('overtime_disposition/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/overtime/disposition/{disposition}/edit", name="overtime_disposition_edit")
     * @param Request $request
     * @param OvertimeDisposition $disposition
     * @return Response
     */
    public function edit(Request $request, OvertimeDisposition $disposition): Response
    {
        $form = $this->createForm(OvertimeDispositionType::class,$disposition);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $disposition->setStartDate($disposition->getStartDate());
            $disposition->setEndDate($disposition->getEndDate());

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zmieniono dane');

            return $this->redirectToRoute('overtime_disposition');
        }

        return $this->render('overtime_disposition/edit.html.twig', [
            'disposition' => $disposition,
            'form' => $form->createView(),
        ]);
    }
}
