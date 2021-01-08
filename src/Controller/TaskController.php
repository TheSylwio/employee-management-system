<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\Task;
use App\Entity\Team;
use App\Form\TaskType;
use App\Service\Helper;
use DateTime;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="tasks")
     * @param Helper $helper
     * @return Response
     */
    public function index(Helper $helper): Response
    {
        return $this->render('tasks/index.html.twig', [
            'tasks' => $helper->getEmployee()->getTasks(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/tasks/add", name="tasks_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCreationDate(new DateTime());
            $assignation = $form->get('assignation')->getData();

            $em = $this->getDoctrine()->getManager();

            if ($assignation instanceof Employee) {
                $task->setEmployee($assignation);
                $em->persist($task);
            }

            if ($assignation instanceof Team) {
                $employees = $assignation->getEmployees();

                foreach ($employees as $employee) {
                    $newTask = clone $task;
                    $newTask->setEmployee($employee);

                    $em->persist($newTask);
                }
            }

            $em->flush();
            $this->addFlash('success', 'Pomyślnie dodano zadanie');

            return $this->redirectToRoute('tasks');
        }

        return $this->render('tasks/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     *
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/task/{task}/edit", name="task_edit")
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function edit(Request $request, Task $task): Response
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Pomyślnie zmieniono zadanie');

            return $this->redirectToRoute('tasks');
        }

        return $this->render('tasks/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/task/{task}/delete", name="task_delete", methods={"POST"})
     * @param Task $task
     * @return Response
     */
    public function delete(Task $task): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($task);
            $em->flush();
        } catch (Exception $exception) {
            $this->addFlash('error', 'Wystąpił błąd podczas usuwania zadania');
            return new JsonResponse($exception->getMessage(), 500);
        }

        $this->addFlash('success', 'Pomyślnie usunięto zadanie');
        return new JsonResponse('Pomyślnie usunięto task', 200);
    }
}
