<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use App\Form\SettingsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     * @return Response
     */
    public function index()
    {
        return $this->render('settings/index.html.twig');
    }

    /**
     * @Route("/settings/email", name="settings_email")
     * @param Request $request
     * @return Response
     */
    public function editEmail(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(SettingsType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zaktualizowano email');
            return $this->redirectToRoute('settings');
        }
        return $this->render('settings/editEmail.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/password", name="settings_password")
     * @param Request $request
     * @return Response
     */
    public function editPassword(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {







            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zaktualizowano hasło');
            return $this->redirectToRoute('index');
        }
        return $this->render('settings/editPassword.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
