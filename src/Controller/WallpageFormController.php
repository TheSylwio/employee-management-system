<?php

namespace App\Controller;

use App\Entity\WallpagePosts;
use App\Form\WallpageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WallpageFormController extends AbstractController
{
    /**
     * @Route("/wallpage", name="wallpage")
     * @param Request $request
     * @return Response
     */


    public function add(Request $request): Response
    {
        $wallpagePost = new WallpagePosts();
        $form = $this->createForm(WallpageType::class, $wallpagePost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wallpagePost);
            $em->flush();

            return $this->redirectToRoute('wallpage');
        }

        return $this->render('wallpage/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
