<?php

namespace App\Controller;

use App\Entity\Events;
use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\Routing\Annotation\Route;

class EventsController extends AbstractController
{
    /**
     * @Route("/events", name="events")
     */
    public function index()
    {
        $repo=$this->getDoctrine()->getRepository(Events::class);
        $events=$repo->findAll();
        return $this->render('events/index.html.twig',[
            'events'=>$events
        ]);

    }
}
