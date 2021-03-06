<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Team;
use App\Form\TeamType;
use App\Service\Helper;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TeamController extends AbstractController
{
    /**
     * @Route("/teams", name="teams")
     * @param Helper $helper
     * @return Response
     */
    public function index(Helper $helper): Response
    {
        return $this->render('team/index.html.twig', [
            'teams' => $helper->getCompany()->getTeams(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/team/add", name="team_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function add(Request $request, Helper $helper): Response
    {
        $team = new Team();
        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $team->setCompany($helper->getCompany());

            $em = $this->getDoctrine()->getManager();
            $em->persist($team);

            foreach ($form->get('employees')->getData() as $employee) {
                $employee->setTeam($team);
                $em->persist($employee);
            }

            $em->flush();

            $this->addFlash('success', 'Pomyślnie dodano drużynę');
            return $this->redirectToRoute('teams');
        }

        return $this->render('team/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/team/{team}/edit", name="team_edit")
     * @param Request $request
     * @param Team $team
     * @param Helper $helper
     * @return Response
     */
    public function edit(Request $request, Team $team, Helper $helper): Response
    {
        $em = $this->getDoctrine()->getManager();
        $employees = $em->getRepository(Employee::class)->findBy(['company' => $helper->getCompany()]);

        $form = $this->createForm(TeamType::class, $team);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($employees as $employee) {
                $employee->setTeam(null);
                $em->persist($employee);
            }

            foreach ($team->getEmployees() as $employee) {
                $employee->setTeam($team);
                $em->persist($employee);
            };

            $em->flush();

            $this->addFlash('success', 'Pomyślnie zaktualizowano zespół');
            return $this->redirectToRoute('teams');
        }

        return $this->render('team/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/team/{team}/delete", name="team_delete",methods={"POST"})
     * @param Team $team
     * @return Response
     */
    public function delete(Team $team): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($team);
            $em->flush();
        } catch (Exception $exception) {
            $this->addFlash('error', 'Wystąpił błąd podczas usuwania zespołu');
            return new JsonResponse($exception->getMessage(), 500);
        }

        $this->addFlash('success', 'Pomyślnie usunięto zespół');
        return new JsonResponse('Pomyślnie usunięto team', 200);
    }
}
