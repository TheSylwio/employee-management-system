<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="tasks")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Task::class);

        return $this->render('tasks/index.html.twig', [
            'tasks' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/tasks/add", name="tasks_add")
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setCreationDate(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            $this->addFlash('success', 'Pomyślnie dodano zadanie');

            return $this->redirectToRoute('tasks');
        }

        return $this->render('tasks/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/tasks/edit/{task}", name="edit_task")
     * Method({"GET", "POST"})
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function edit(Request $request, Task $task)
    {
        $form = $this->createForm(TaskType::class,$task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Pomyślnie zmieniono zadanie');
            return $this->redirectToRoute('tasks');
        }
        return $this->render('tasks/edit.html.twig', [
                'form' => $form->createView()
            ]
        );
    }
}
