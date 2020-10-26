<?php

namespace App\Controller;

use App\Form\TestType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/employee/contact", name="test")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $form = $this->createForm(TestType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            dump($form->getData());

            // 1. Formularze
            // 2. Baza Danych
            // 3. Tworzenie tabel (Entity)
            // 4. Wyciąganie danych z repozytoriów
            // 5. Tworzenie szablonów


//            return $this->redirectToRoute('test');
        }

        return $this->render('test/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
