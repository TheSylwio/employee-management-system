<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DanielController extends AbstractController
{
    /**
     * @Route("/daniel", name="daniel")
     */
    public function index()
    {
        return $this->render('daniel/index.html.twig', [
            'controller_name' => 'DanielController',
        ]);
    }
}
