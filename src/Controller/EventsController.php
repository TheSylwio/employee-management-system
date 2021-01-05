<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Service\Helper;
use mysql_xdevapi\Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     * @param Helper $helper
     * @return Response
     */
    public function index(Helper $helper): Response
    {
        return $this->render('events/index.html.twig', [
            'events' => $helper->getCompany()->getEvents(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/events/add", name="events_add")
     * @param Request $request
     * @param Helper $helper
     * @return Response
     */
    public function add(Request $request, Helper $helper): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->setCompany($helper->getCompany());

            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();
            $this->addFlash('success', 'Pomyślnie dodano wydarzenie');

            return $this->redirectToRoute('events');
        }

        return $this->render('events/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/event/{event}/edit", name="event_edit")
     * @param Request $request
     * @param Event $event
     * @return Response
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zmieniono wydarzenie');

            return $this->redirectToRoute('events');
        }

        return $this->render('events/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYER")
     * @Route("/event/{event}/delete", name="event_delete", methods={"POST"})
     * @param Event $event
     * @return Response
     */
    public function delete(Event $event): Response
    {
        try {
            $em = $this->getDoctrine()->getManager();
            $em->remove($event);
            $em->flush();
        } catch (Exception $exception) {
            $this->addFlash('error', 'Wystąpił błąd podczas usuwania wydarzenia');
            return new JsonResponse($exception, 500);
        }

        $this->addFlash('success', 'Pomyślnie usunięto wydarzenie');
        return new JsonResponse('Pomyślnie usunięto wydarzenie', 200);
    }
}
