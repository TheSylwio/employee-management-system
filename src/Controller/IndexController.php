<?php

namespace App\Controller;

use App\Entity\WallpagePosts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getRepository(WallpagePosts::class);

        return $this->render('index/index.html.twig', [
            'posts' => $repo->findAll()
        ]);
    }
}
