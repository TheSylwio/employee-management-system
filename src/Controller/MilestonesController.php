<?php

namespace App\Controller;

use App\Entity\Milestone;
use App\Form\MilestonesType;
use App\Service\Helper;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MilestonesController extends AbstractController
{
    /**
     * @Route("/milestones", name="milestones")
     * @param Helper $helper
     * @return Response
     */
    public function index(Helper $helper): Response
    {
        return $this->render('milestones/index.html.twig', [
            'milestones' => $helper->getCompany()->getMilestones(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/milestones/add", name="milestone_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function add(Request $request, Helper $helper): Response
    {
        $milestone = new Milestone();
        $form = $this->createForm(MilestonesType::class, $milestone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $milestone->setCompany($helper->getCompany());
            $em = $this->getDoctrine()->getManager();
            $em->persist($milestone);
            $em->flush();
            $this->addFlash('success', 'Pomyślnie dodano kamień milowy');

            return $this->redirectToRoute('milestones');
        }

        return $this->render('milestones/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/milestone/{milestone}", name="milestone_show")
     * @param Milestone $milestone
     * @return Response
     */
    public function show(Milestone $milestone): Response
    {
        return $this->render('milestones/description.html.twig', [
            'milestone' => $milestone,
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/milestone/{milestone}/edit", name="milestone_edit")
     * @param Request $request
     * @param Milestone $milestone
     * @return Response
     */
    public function edit(Request $request, Milestone $milestone): Response
    {
        $form = $this->createForm(MilestonesType::class, $milestone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zmieniono kamień milowy');

            return $this->redirectToRoute('milestones');
        }

        return $this->render('milestones/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/milestone/{milestone}/delete", name="milestone_delete", methods={"POST"})
     * @param Milestone $milestone
     * @return Response
     */
    public function delete(Milestone $milestone): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($milestone);
            $em->flush();
        } catch (Exception $exception) {
            $this->addFlash('error', 'Wystąpił błąd podczas usuwania kamienia milowego');
            return new JsonResponse($exception->getMessage(), 500);
        }

        $this->addFlash('success', 'Pomyślnie usunięto kamień milowy');
        return new JsonResponse('Pomyślnie usunięto milowy', 200);
    }
}
