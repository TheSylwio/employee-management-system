<?php

namespace App\Controller;

use App\Entity\Overtime;
use App\Service\Helper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OvertimeController extends AbstractController
{
    /*
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
     * @Route("/overtime/add", name="overtime_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function add(Request $request, Helper $helper): Response
    {
        $overtime = new Overtime();
        $form = $this->createForm(OvertimeDispositionType::class,$overtime);
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
}
