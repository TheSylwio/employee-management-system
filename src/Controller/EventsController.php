<?php

namespace App\Controller;

use App\Entity\Event;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(Event::class);

        return $this->render('events/index.html.twig', [
            'events' => $repo->findAll(),
        ]);
    }
}
