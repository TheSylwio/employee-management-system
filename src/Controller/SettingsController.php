<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangeEmailType;
use App\Form\ChangePasswordType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SettingsController extends AbstractController
{
    /**
     * @Route("/settings", name="settings")
     * @return Response
     */
    public function index(): Response
    {
        return $this->render('settings/index.html.twig');
    }

    /**
     * @Route("/settings/email", name="settings_email")
     * @param Request $request
     * @return Response
     */
    public function editEmail(Request $request): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangeEmailType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Pomyślnie zaktualizowano email');
            return $this->redirectToRoute('settings');
        }

        return $this->render('settings/change_email.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/settings/password", name="settings_password")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function editPassword(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $oldPassword = $form->get('password');
            $newPassword = $form->get('newPassword');
            $confirmNewPassword = $form->get('confirmNewPassword');

            $isPasswordValid = $passwordEncoder->isPasswordValid($user, $oldPassword->getData());
            $arePasswordsEqual = $newPassword->getData() === $confirmNewPassword->getData();

            if (!$isPasswordValid) {
                $oldPassword->addError(new FormError('Wpisane hasło jest nieprawidłowe'));
            }

            if (!$arePasswordsEqual) {
                $newPassword->addError(new FormError('Podane hasła nie są jednakowe'));
                $confirmNewPassword->addError(new FormError('Podane hasła nie są jednakowe'));
            }

            if ($isPasswordValid && $arePasswordsEqual) {
                /** @var User $user */
                $user->setPassword($passwordEncoder->encodePassword($user, $newPassword->getData()));

                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $this->addFlash('success', 'Pomyślnie zaktualizowano hasło');
                return $this->redirectToRoute('index');
            }
        }

        return $this->render('settings/change_password.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
